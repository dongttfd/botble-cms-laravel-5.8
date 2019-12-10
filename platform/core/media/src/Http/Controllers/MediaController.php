<?php

namespace Botble\Media\Http\Controllers;

use Auth;
use Botble\Media\Models\MediaFile;
use Botble\Media\Models\MediaFolder;
use Botble\Media\Repositories\Interfaces\MediaFileInterface;
use Botble\Media\Repositories\Interfaces\MediaFolderInterface;
use Botble\Media\Repositories\Interfaces\MediaSettingInterface;
use Botble\Media\Services\UploadsManager;
use Chumper\Zipper\Zipper;
use Exception;
use File;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Image;
use RvMedia;
use Storage;

/**
 * Class MediaController
 * @package Botble\Media\Http\Controllers
 * 
 * @since 19/08/2015 08:05 AM
 */
class MediaController extends Controller
{
    /**
     * @var MediaFileInterface
     */
    protected $fileRepository;

    /**
     * @var MediaFolderInterface
     */
    protected $folderRepository;

    /**
     * @var UploadsManager
     */
    protected $uploadManager;

    /**
     * @var MediaSettingInterface
     */
    protected $mediaSettingRepository;

    /**
     * MediaController constructor.
     * @param MediaFileInterface $fileRepository
     * @param MediaFolderInterface $folderRepository
     * @param MediaSettingInterface $mediaSettingRepository
     * @param UploadsManager $uploadManager
     * 
     */
    public function __construct(
        MediaFileInterface $fileRepository,
        MediaFolderInterface $folderRepository,
        MediaSettingInterface $mediaSettingRepository,
        UploadsManager $uploadManager
    )
    {
        $this->fileRepository = $fileRepository;
        $this->folderRepository = $folderRepository;
        $this->uploadManager = $uploadManager;
        $this->mediaSettingRepository = $mediaSettingRepository;
    }

    /**
     * @return string
     * 
     */
    public function getMedia(Request $request)
    {
        page_title()->setTitle(trans('media::media.menu_name'));

        if ($request->input('media-action') === 'select-files') {
            return view('media::popup');
        }

        return view(config('media.views.index'));
    }

    /**
     * @return string
     * 
     * @throws \Throwable
     */
    public function getPopup()
    {
        return view('media::popup')->render();
    }

    /**
     * Get list files & folders
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 
     */
    public function getList(Request $request)
    {
        $files = [];
        $folders = [];
        $breadcrumbs = [];

        $orderBy = $this->transformOrderBy($request->input('sort_by'));

        if ($request->has('is_popup') && $request->has('selected_file_id') && $request->input('selected_file_id') != null) {
            $current_file = $this->fileRepository->getFirstBy(['id' => $request->input('selected_file_id')], ['folder_id']);
            if ($current_file) {
                $request->merge(['folder_id' => $current_file->folder_id]);
            }
        }

        $paramsFolder = [];

        $paramsFile = [
            'order_by'         => [
                'is_folder' => 'DESC',
                $orderBy[0] => $orderBy[1],
            ],
            'paginate'         => [
                'per_page'      => $request->input('posts_per_page', 30),
                'current_paged' => $request->input('paged', 1),
            ],
            'selected_file_id' => $request->input('selected_file_id'),
            'is_popup'         => $request->input('is_popup'),
            'filter'           => $request->input('filter'),
        ];

        if ($request->input('search')) {
            $paramsFolder['condition'] = [
                ['media_folders.name', 'LIKE', '%' . $request->input('search') . '%',],
            ];

            $paramsFile['condition'] = [
                ['media_files.name', 'LIKE', '%' . $request->input('search') . '%',],
            ];
        }

        switch ($request->input('view_in')) {
            case 'all_media':
                $breadcrumbs = [
                    [
                        'id'   => 0,
                        'name' => trans('media::media.all_media'),
                        'icon' => 'fa fa-user-secret',
                    ],
                ];

                $queried = $this->fileRepository->getFilesByFolderId($request->input('folder_id'), $paramsFile, true, $paramsFolder);

                $folders = $queried->where('is_folder', 1)->map(function ($item) {
                    return $this->getResponseFolderData($item);
                })->toArray();

                $files = $queried->where('is_folder', 0)->map(function ($item) {
                    return $this->getResponseFileData($item);
                })->toArray();

                break;

            case 'trash':
                $breadcrumbs = [
                    [
                        'id'   => 0,
                        'name' => trans('media::media.trash'),
                        'icon' => 'fa fa-trash',
                    ],
                ];

                $queried = $this->fileRepository->getTrashed($request->input('folder_id'), $paramsFile, true, $paramsFolder);

                $folders = $queried->where('is_folder', 1)->map(function ($item) {
                    return $this->getResponseFolderData($item);
                })->toArray();

                $files = $queried->where('is_folder', 0)->map(function ($item) {
                    return $this->getResponseFileData($item);
                })->toArray();

                break;

            case 'recent':
                $breadcrumbs = [
                    [
                        'id'   => 0,
                        'name' => trans('media::media.recent'),
                        'icon' => 'fa fa-clock',
                    ],
                ];

                $queried = $this->fileRepository->getFilesByFolderId(-1, array_merge($paramsFile, [
                    'recent_items' => $request->input('recent_items', []),
                ]), false, $paramsFolder);

                $files = $queried->map(function ($item) {
                    return $this->getResponseFileData($item);
                })->toArray();

                break;
            case 'favorites':
                $breadcrumbs = [
                    [
                        'id'   => 0,
                        'name' => trans('media::media.favorites'),
                        'icon' => 'fa fa-star',
                    ],
                ];

                $favorite_items = $this->mediaSettingRepository->getFirstBy(['key' => 'favorites', 'user_id' => Auth::user()->getKey()]);

                if (!empty($favorite_items)) {
                    $file_ids = collect($favorite_items->value)
                        ->where('is_folder', 'false')
                        ->pluck('id')
                        ->all();

                    $folder_ids = collect($favorite_items->value)
                        ->where('is_folder', 'true')
                        ->pluck('id')
                        ->all();

                    if ($file_ids) {
                        $paramsFile = array_merge_recursive($paramsFile, [
                            ['media_files.id', 'IN', $file_ids],
                        ]);
                    }

                    if ($folder_ids) {
                        $paramsFolder = array_merge_recursive($paramsFolder, [
                            'condition' => [
                                ['media_folders.id', 'IN', $folder_ids],
                            ],
                        ]);
                    }

                    $queried = $this->fileRepository->getFilesByFolderId($request->input('folder_id'), $paramsFile, true, $paramsFolder);

                    $folders = $queried->where('is_folder', 1)->map(function ($item) {
                        return $this->getResponseFolderData($item);
                    })->toArray();

                    $files = $queried->where('is_folder', 0)->map(function ($item) {
                        return $this->getResponseFileData($item);
                    })->toArray();
                }

                break;
        }

        $breadcrumbs = array_merge($breadcrumbs, $this->getBreadcrumbs($request));
        $selected_file_id = $request->input('selected_file_id');
        return RvMedia::responseSuccess(compact('files', 'folders', 'breadcrumbs', 'selected_file_id'));
    }

    /**
     * @param $folder
     * @return array
     * 
     */
    protected function getResponseFolderData($folder)
    {
        if (empty($folder)) {
            return [];
        }

        return [
            'id'         => $folder->id,
            'name'       => $folder->name,
            'created_at' => date_from_database($folder->created_at, 'Y-m-d H:i:s'),
            'updated_at' => date_from_database($folder->updated_at, 'Y-m-d H:i:s'),
        ];
    }

    /**
     * @param $file
     * @return array
     * 
     */
    protected function getResponseFileData($file)
    {
        if (empty($file)) {
            return [];
        }

        $url = $file->url;

        if (config('filesystems.default') == 'local' && !Str::contains($file->url, 'https://')) {
            $url = '/' . ltrim($file->url, '/');
        }

        return [
            'id'         => $file->id,
            'name'       => $file->name,
            'basename'   => File::basename($file->url),
            'url'        => $url,
            'full_url'   => url($file->url),
            'type'       => $file->type,
            'icon'       => $file->icon,
            'thumb'      => $file->type == 'image' ? get_image_url($file->url, 'thumb') : null,
            'size'       => $file->human_size,
            'mime_type'  => $file->mime_type,
            'created_at' => date_from_database($file->created_at, 'Y-m-d H:i:s'),
            'updated_at' => date_from_database($file->updated_at, 'Y-m-d H:i:s'),
            'options'    => $file->options,
            'folder_id'  => $file->folder_id,

        ];
    }

    /**
     * @param Request $request
     * @return array
     * 
     */
    protected function getBreadcrumbs(Request $request)
    {
        if ($request->input('folder_id') == 0) {
            return [];
        }

        if ($request->input('view_in') == 'trash') {
            $folder = $this->folderRepository->getFirstByWithTrash(['id' => $request->input('folder_id')]);
        } else {
            $folder = $this->folderRepository->getFirstBy(['id' => $request->input('folder_id')]);
        }
        if (empty($folder)) {
            return [];
        }

        if (empty($breadcrumbs)) {
            $breadcrumbs = [
                [
                    'name' => $folder->name,
                    'id'   => $folder->id,
                ],
            ];
        }

        $child = $this->folderRepository->getBreadcrumbs($folder->parent_id);
        if (!empty($child)) {
            return array_merge($child, $breadcrumbs);
        }

        return $breadcrumbs;
    }

    /**
     * Get user quota
     *
     * @return \Illuminate\Http\JsonResponse
     * 
     */
    public function getQuota()
    {
        return RvMedia::responseSuccess([
            'quota'   => human_file_size($this->fileRepository->getQuota()),
            'used'    => human_file_size($this->fileRepository->getSpaceUsed()),
            'percent' => $this->fileRepository->getPercentageUsed(),
        ]);
    }

    /**
     * @param string $orderBy
     * @return array
     */
    protected function transformOrderBy($orderBy)
    {
        $result = explode('-', $orderBy);
        if (!count($result) == 2) {
            return ['name', 'asc'];
        }
        return $result;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function postGlobalActions(Request $request)
    {
        $response = RvMedia::responseError(trans('media::media.invalid_action'));

        $type = $request->input('action');
        switch ($type) {
            case 'trash':
                $error = false;
                foreach ($request->input('selected') as $item) {
                    $id = $item['id'];
                    if ($item['is_folder'] == 'false') {
                        try {
                            $this->fileRepository->deleteBy(['id' => $id]);
                        } catch (Exception $exception) {
                            info($exception->getMessage());
                            $error = true;
                        }
                    } else {
                        $this->folderRepository->deleteFolder($id);
                    }
                }

                if ($error) {
                    $response = RvMedia::responseError(trans('media::media.trash_error'));
                    break;
                }

                $response = RvMedia::responseSuccess([], trans('media::media.trash_success'));
                break;

            case 'restore':
                $error = false;
                foreach ($request->input('selected') as $item) {
                    $id = $item['id'];
                    if ($item['is_folder'] == 'false') {
                        try {
                            $this->fileRepository->restoreBy(['id' => $id]);
                        } catch (Exception $exception) {
                            info($exception->getMessage());
                            $error = true;
                        }
                    } else {
                        $this->folderRepository->restoreFolder($id);
                    }
                }

                if ($error) {
                    $response = RvMedia::responseError(trans('media::media.restore_error'));
                    break;
                }

                $response = RvMedia::responseSuccess([], trans('media::media.restore_success'));
                break;

            case 'make_copy':
                foreach ($request->input('selected', []) as $item) {
                    $id = $item['id'];
                    if ($item['is_folder'] == 'false') {
                        $file = $this->fileRepository->getFirstBy(['id' => $id]);
                        $this->copyFile($file);
                    } else {
                        $old_folder = $this->folderRepository->getFirstBy(['id' => $id]);
                        $folderData = $old_folder->replicate()->toArray();

                        $folderData['slug'] = $this->folderRepository->createSlug($old_folder->name, $old_folder->parent_id);
                        $folderData['name'] = $old_folder->name . '-(copy)';
                        $folderData['user_id'] = Auth::user()->getKey();
                        $folder = $this->folderRepository->create($folderData);

                        $files = $this->fileRepository->getFilesByFolderId($id);
                        foreach ($files as $file) {
                            $this->copyFile($file, $folder->id);
                        }

                        $children = $this->folderRepository->getAllChildFolders($id);
                        foreach ($children as $parent_id => $child) {
                            if ($parent_id != $old_folder->id) {
                                /**
                                 * @var MediaFolder $child
                                 */
                                $folder = $this->folderRepository->getFirstBy(['id' => $parent_id]);

                                $folderData = $folder->replicate()->toArray();

                                $folderData['slug'] = $this->folderRepository->createSlug($old_folder->name, $old_folder->parent_id);
                                $folderData['name'] = $old_folder->name . '-(copy)';
                                $folderData['user_id'] = Auth::user()->getKey();
                                $folderData['parent_id'] = $folder->id;
                                $folder = $this->folderRepository->create($folderData);

                                $parent_files = $this->fileRepository->getFilesByFolderId($parent_id);
                                foreach ($parent_files as $parent_file) {
                                    $this->copyFile($parent_file, $folder->id);
                                }
                            }

                            foreach ($child as $sub) {
                                /**
                                 * @var \Eloquent $sub
                                 */
                                $sub_files = $this->fileRepository->getFilesByFolderId($sub->id);

                                $subFolderData = $sub->replicate()->toArray();

                                $subFolderData['user_id'] = Auth::user()->getKey();
                                $subFolderData['parent_id'] = $folder->id;

                                $sub = $this->folderRepository->create($subFolderData);

                                foreach ($sub_files as $sub_file) {
                                    $this->copyFile($sub_file, $sub->id);
                                }
                            }
                        }

                        $allFiles = Storage::disk()->allFiles($this->folderRepository->getFullPath($old_folder->id));
                        foreach ($allFiles as $file) {
                            Storage::disk()->copy($file, str_replace($old_folder->slug, $folder->slug, $file));
                        }
                    }
                }

                $response = RvMedia::responseSuccess([], trans('media::media.copy_success'));
                break;

            case 'delete':
                foreach ($request->input('selected') as $item) {
                    $id = $item['id'];
                    if ($item['is_folder'] == 'false') {
                        try {
                            $this->fileRepository->forceDelete(['id' => $id]);
                        } catch (Exception $exception) {
                            info($exception->getMessage());
                        }
                    } else {
                        $this->folderRepository->deleteFolder($id, true);
                    }
                }

                $response = RvMedia::responseSuccess([], trans('media::media.delete_success'));
                break;
            case 'favorite':
                $meta = $this->mediaSettingRepository->firstOrCreate(['key' => 'favorites', 'user_id' => Auth::user()->getKey()]);
                if (!empty($meta->value)) {
                    $meta->value = array_merge($meta->value, $request->input('selected', []));
                } else {
                    $meta->value = $request->input('selected', []);
                }

                $this->mediaSettingRepository->createOrUpdate($meta);

                $response = RvMedia::responseSuccess([], trans('media::media.favorite_success'));
                break;

            case 'remove_favorite':
                $meta = $this->mediaSettingRepository->firstOrCreate(['key' => 'favorites', 'user_id' => Auth::user()->getKey()]);
                if (!empty($meta)) {
                    $value = $meta->value;
                    if (!empty($value)) {
                        foreach ($value as $key => $item) {
                            foreach ($request->input('selected') as $selected_item) {
                                if ($item['is_folder'] == $selected_item['is_folder'] && $item['id'] == $selected_item['id']) {
                                    unset($value[$key]);
                                }
                            }
                        }
                        $meta->value = $value;

                        $this->mediaSettingRepository->createOrUpdate($meta);
                    }
                }

                $response = RvMedia::responseSuccess([], trans('media::media.remove_favorite_success'));
                break;

            case 'rename':
                $error = false;
                foreach ($request->input('selected') as $item) {
                    $id = $item['id'];
                    if ($item['is_folder'] == 'false') {
                        $file = $this->fileRepository->getFirstBy(['id' => $id]);

                        if (!empty($file)) {
                            $file->name = $this->fileRepository->createName($item['name'], $file->folder_id);
                            $this->fileRepository->createOrUpdate($file);
                        }
                    } else {
                        $name = $item['name'];
                        $folder = $this->folderRepository->getFirstBy(['id' => $id]);

                        if (!empty($folder)) {
                            $folder->name = $this->folderRepository->createName($name, $folder->parent_id);
                            $this->folderRepository->createOrUpdate($folder);
                        }
                    }
                }

                if (!empty($error)) {
                    $response = RvMedia::responseError(trans('media::media.rename_error'));
                    break;
                }

                $response = RvMedia::responseSuccess([], trans('media::media.rename_success'));
                break;

            case 'empty_trash':
                $this->folderRepository->emptyTrash();
                $this->fileRepository->emptyTrash();

                $response = RvMedia::responseSuccess([], trans('media::media.empty_trash_success'));
                break;
        }

        return $response;
    }

    /**
     * @param $file
     * @param int $new_folder_id
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * 
     */
    protected function copyFile($file, $new_folder_id = null)
    {
        /**
         * @var MediaFile $file ;
         */
        $file = $file->replicate();
        $file->user_id = Auth::user()->getKey();

        $fileData = $file->toArray();
        $fileData['user_id'] = Auth::user()->getKey();

        if ($new_folder_id == null) {
            $fileData['name'] = $file->name . '-(copy)';

            if (!in_array($file->type, array_merge(['video', 'youtube'], config('media.external_services')))) {
                $folder_path = Str::finish($this->folderRepository->getFullPath($file->folder_id), '/');
                $path = $folder_path . File::name($file->url) . '-(copy)' . '.' . File::extension($file->url);

                $file_path = $file->url;
                if (config('filesystems.default') === 'local' && !Str::contains($file->url, 'https://')) {
                    $file_path = public_path($file->url);
                }
                if (file_exists($file_path)) {
                    $content = File::get($file_path);

                    $this->uploadManager->saveFile($path, $content);
                    $data = $this->uploadManager->fileDetails($path);
                    $fileData['url'] = $data['url'];

                    if (is_image($this->uploadManager->fileMimeType($path))) {
                        foreach (config('media.sizes') as $size) {
                            $readable_size = explode('x', $size);
                            Image::make(ltrim($data['url'], '/'))
                                ->fit($readable_size[0], $readable_size[1])
                                ->save(ltrim($this->uploadManager->uploadPath($folder_path), '/') . File::name($data['url']) . '-' . $size . '.' . File::extension($data['url']));
                        }
                    }
                }
            }
        } else {
            $fileData['url'] = str_replace(
                $this->uploadManager->uploadPath($this->folderRepository->getFullPath($file->folder_id)),
                $this->uploadManager->uploadPath($this->folderRepository->getFullPath($new_folder_id)),
                $file->url
            );
            $fileData['folder_id'] = $new_folder_id;
        }

        $this->fileRepository->create($fileData);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|\Illuminate\Http\JsonResponse
     * 
     * @throws Exception
     */
    public function download(Request $request)
    {
        $items = $request->input('selected', []);

        if (count($items) == 1 && $items['0']['is_folder'] == 'false') {
            $file = $this->fileRepository->getFirstByWithTrash(['id' => $items[0]['id']]);
            if (!empty($file) && $file->type != 'video') {
                if (config('filesystems.default') == 'local' && !Str::contains($file->url, 'https://')) {
                    $file_path = public_path($file->url);
                    if (!file_exists($file_path)) {
                        return RvMedia::responseError(trans('media::media.file_not_exists'));
                    }
                    return response()->download($file_path);
                }

                $file_path = $file->url;
                return response()->make(file_get_contents(str_replace('https://', 'http://', $file_path)), 200, [
                    'Content-type'        => $file->mime_type,
                    'Content-Disposition' => 'attachment; filename="' . $file->name . '.' . File::extension($file->url) . '"',
                ]);
            }
        } else {
            $file_name = public_path('uploads/download-' . now(config('app.timezone'))->format('Y-m-d-h-i-s') . '.zip');
            $zip = new Zipper;
            $zip->make($file_name);
            foreach ($items as $item) {
                $id = $item['id'];
                if ($item['is_folder'] == 'false') {
                    $file = $this->fileRepository->getFirstByWithTrash(['id' => $id]);
                    if (!empty($file) && $file->type != 'video') {
                        if (config('filesystems.default') == 'local' && !Str::contains($file->url, 'https://')) {
                            $zip->add(public_path($file->url));
                        } else {
                            $zip->addString(File::basename($file->url), file_get_contents(str_replace('https://', 'http://', $file->url)));
                        }
                    }
                } else {
                    $folder = $this->folderRepository->getFirstByWithTrash(['id' => $id]);
                    if (!empty($folder)) {
                        if (config('filesystems.default') == 'local') {
                            $zip->add(ltrim($this->uploadManager->uploadPath($this->folderRepository->getFullPath($folder->id)), '/'));
                        } else {
                            $allFiles = Storage::disk()->allFiles($this->folderRepository->getFullPath($folder->id));
                            foreach ($allFiles as $file) {
                                $zip->addString(File::basename($file), file_get_contents(str_replace('https://', 'http://', $this->uploadManager->uploadPath($file))));
                            }
                        }
                    }
                }
            }

            $zip->close();

            if (File::exists($file_name)) {
                return response()->download($file_name)->deleteFileAfterSend(true);
            }

            return RvMedia::responseError(trans('media::media.download_file_error'));
        }
        return RvMedia::responseError(trans('media::media.can_not_download_file'));
    }
}
