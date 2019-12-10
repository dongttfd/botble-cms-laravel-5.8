<?php

namespace Botble\Member\Http\Controllers;

use Assets;
use Auth;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Media\Http\Requests\MediaFileRequest;
use Botble\Media\Repositories\Interfaces\MediaFileInterface;
use Botble\Media\Services\ThumbnailService;
use Botble\Media\Services\UploadsManager;
use Botble\Member\Http\Requests\AvatarRequest;
use Botble\Member\Http\Requests\SettingRequest;
use Botble\Member\Http\Requests\UpdatePasswordRequest;
use Botble\Member\Repositories\Interfaces\MemberActivityLogInterface;
use Botble\Member\Repositories\Interfaces\MemberInterface;
use Exception;
use File;
use Hash;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Intervention\Image\ImageManager;
use RvMedia;
use SeoHelper;
use Validator;

class PublicController extends Controller
{
    /**
     * @var MemberInterface
     */
    protected $memberRepository;

    /**
     * @var MemberActivityLogInterface
     */
    protected $activityLogRepository;

    /**
     * @var MediaFileInterface
     */
    protected $fileRepository;

    /**
     * PublicController constructor.
     * @param Repository $config
     * @param MemberInterface $memberRepository
     * @param MemberActivityLogInterface $memberActivityLogRepository
     * @param MediaFileInterface $fileRepository
     */
    public function __construct(
        Repository $config,
        MemberInterface $memberRepository,
        MemberActivityLogInterface $memberActivityLogRepository,
        MediaFileInterface $fileRepository
    ) {
        $this->memberRepository = $memberRepository;
        $this->activityLogRepository = $memberActivityLogRepository;
        $this->fileRepository = $fileRepository;

        Assets::setConfig($config->get('plugins.member.assets'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function getDashboard()
    {
        $user = auth()->guard('member')->user();

        SeoHelper::setTitle(auth()->guard('member')->user()->getFullName());

        return view('plugins/member::dashboard.index', compact('user'));
    }

    /**
     * @return \Response
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getSettings()
    {
        SeoHelper::setTitle(__('Account settings'));

        $user = auth()->guard('member')->user();

        return view('plugins/member::settings.index', compact('user'));
    }

    /**
     * @param SettingRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function postSettings(SettingRequest $request, BaseHttpResponse $response)
    {
        $year = $request->input('year');
        $month = $request->input('month');
        $day = $request->input('day');

        if ($year && $month && $day) {
            $request->merge(['dob' => implode('-', [$year, $month, $day])]);

            $validator = Validator::make($request->input(), [
                'dob' => 'nullable|date',
            ]);

            if ($validator->fails()) {
                return redirect()->route('public.member.settings');
            }
        }

        $this->memberRepository->createOrUpdate($request->except('email'), ['id' => auth()->guard('member')->user()->getKey()]);

        $this->activityLogRepository->createOrUpdate(['action' => 'update_setting']);

        return $response
            ->setNextUrl(route('public.member.settings'))
            ->setMessage(__('Update profile successfully!'));
    }

    /**
     * @return \Response
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getSecurity()
    {
        SeoHelper::setTitle(__('Security'));

        return view('plugins/member::settings.security');
    }

    /**
     * @param UpdatePasswordRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function postSecurity(UpdatePasswordRequest $request, BaseHttpResponse $response)
    {
        if (!Hash::check($request->input('current_password'), auth()->guard('member')->user()->getAuthPassword())) {
            return $response
                ->setError()
                ->setMessage(trans('plugins/member::dashboard.current_password_not_valid'));
        }

        $this->memberRepository->update(['id' => auth()->guard('member')->user()->getKey()], [
            'password' => bcrypt($request->input('password')),
        ]);

        $this->activityLogRepository->createOrUpdate(['action' => 'update_security']);

        return $response->setMessage(trans('plugins/member::dashboard.password_update_success'));
    }

    /**
     * @param AvatarRequest $request
     * @param UploadsManager $uploadManager
     * @param ImageManager $imageManager
     * @param ThumbnailService $thumbnailService
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function postAvatar(
        AvatarRequest $request,
        UploadsManager $uploadManager,
        ImageManager $imageManager,
        ThumbnailService $thumbnailService,
        BaseHttpResponse $response
    )
    {
        try {
            $fileUpload = $request->file('avatar_file');

            $file_ext = $fileUpload->getClientOriginalExtension();

            $folder_path = '/members';

            $fileName = $this->fileRepository->createName(File::name($fileUpload->getClientOriginalName()), 0);

            $fileName = $this->fileRepository->createSlug($fileName, $file_ext, $uploadManager->uploadPath($folder_path));

            $member = $this->memberRepository->findById(Auth::guard('member')->user()->getKey());

            $image = $imageManager->make($request->file('avatar_file')->getRealPath());
            $avatarData = json_decode($request->input('avatar_data'));
            $image->crop((int)$avatarData->height, (int)$avatarData->width, (int) $avatarData->x, (int) $avatarData->y);
            $path = $folder_path . '/' . $fileName;

            $uploadManager->saveFile($path, $image->stream()->__toString());

            $readable_size = explode('x', config('media.sizes.thumb'));

            $thumbnailService
                ->setImage($fileUpload->getRealPath())
                ->setSize($readable_size[0], $readable_size[1])
                ->setDestinationPath($folder_path)
                ->setFileName(File::name($fileName) . '-' . config('media.sizes.thumb') . '.' . $file_ext)
                ->save();

            $data = $uploadManager->fileDetails($path);

            $file = $this->fileRepository->getModel();
            $file->name = $fileName;
            $file->url = $data['url'];
            $file->size = $data['size'];
            $file->mime_type = $data['mime_type'];
            $file->folder_id = 0;
            $file->user_id = 0;
            $file->options = [];
            $file = $this->fileRepository->createOrUpdate($file);

            $this->fileRepository->forceDelete(['id' => $member->avatar_id]);

            $member->avatar_id = $file->id;

            $this->memberRepository->createOrUpdate($member);

            $this->activityLogRepository->createOrUpdate([
                'action' => 'changed_avatar',
            ]);

            return $response
                ->setMessage(trans('plugins/member::dashboard.update_avatar_success'))
                ->setData(['url' => url($data['url'])]);
        } catch (Exception $ex) {
            return $response
                ->setError()
                ->setMessage($ex->getMessage());
        }
    }

    /**
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function getActivityLogs(BaseHttpResponse $response)
    {
        $activities = $this->activityLogRepository->getAllLogs(auth()->guard('member')->user()->getKey());

        foreach ($activities->items() as &$activity) {
            $activity->description = $activity->getDescription();
        }

        return $response->setData($activities);
    }

    /**
     * @param MediaFileRequest $request
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function postUpload(MediaFileRequest $request)
    {
        $result = RvMedia::handleUpload($request->file('upload'), 0, 'members');

        if ($result['error'] == false) {
            $file = $result['data'];
            return response('<script>parent.setImageValue("' . url($file->url) . '"); </script>')->header('Content-Type',
                'text/html');
        }

        return response('<script>alert("' . Arr::get($result, 'message') . '")</script>')->header('Content-Type',
            'text/html');
    }
}
