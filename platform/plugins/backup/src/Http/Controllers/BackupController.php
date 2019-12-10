<?php

namespace Botble\Backup\Http\Controllers;

use App\Console\Kernel;
use Assets;
use Botble\Backup\Supports\Backup;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Exception;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BackupController extends BaseController
{

    /**
     * @var Backup
     */
    protected $backup;

    /**
     * BackupController constructor.
     * @param Backup $backup
     *
     */
    public function __construct(Backup $backup)
    {
        $this->backup = $backup;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getIndex()
    {
        page_title()->setTitle(trans('plugins/backup::backup.menu_name'));

        Assets::addScriptsDirectly(['vendor/core/plugins/backup/js/backup.js'])
            ->addStylesDirectly(['vendor/core/plugins/backup/css/backup.css']);

        $backups = $this->backup->getBackupList();

        return view('plugins/backup::index', compact('backups'));
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     * @throws \Throwable
     */
    public function postCreate(Request $request, BaseHttpResponse $response)
    {
        try {
            $data = $this->backup->createBackupFolder($request);
            $this->backup->backupDb();
            $this->backup->backupFolder(public_path('uploads'));
            do_action(BACKUP_ACTION_AFTER_BACKUP, BACKUP_MODULE_SCREEN_NAME, $request);

            return $response
                ->setData(view('plugins/backup::partials.backup-item', $data)->render())
                ->setMessage(trans('plugins/backup::backup.create_backup_success'));
        } catch (Exception $ex) {
            return $response
                ->setError()
                ->setMessage($ex->getMessage());
        }
    }

    /**
     * @param string $folder
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     */
    public function getDelete($folder, BaseHttpResponse $response)
    {
        try {
            $this->backup->deleteFolderBackup(storage_path('app/backup/') . $folder);
            return $response->setMessage(trans('plugins/backup::backup.delete_backup_success'));
        } catch (Exception $ex) {
            return $response
                ->setError()
                ->setMessage($ex->getMessage());
        }
    }

    /**
     * @param string $folder
     * @param Request $request
     * @param BaseHttpResponse $response
     * @param Kernel $kernel
     * @return BaseHttpResponse
     *
     */
    public function getRestore($folder, Request $request, BaseHttpResponse $response, Kernel $kernel)
    {
        try {
            info('Starting restore backup...');
            $path = storage_path('app/backup/') . $folder;
            foreach (scan_folder($path) as $file) {
                if (Str::contains(basename($file), 'database')) {
                    $this->backup->restoreDb($path . DIRECTORY_SEPARATOR . $file, $path);
                }

                if (Str::contains(basename($file), 'uploads')) {
                    $pathTo = public_path('uploads');
                    foreach (File::glob(rtrim($pathTo, '/') . '/*') as $item) {
                        if (File::isDirectory($item)) {
                            File::deleteDirectory($item);
                        } elseif (!in_array(File::basename($item), ['.htaccess', '.gitignore'])) {
                            File::delete($item);
                        }
                    }

                    $this->backup->restore($path . DIRECTORY_SEPARATOR . $file, $pathTo);
                }
            }

            $kernel->call('cache:clear');

            try {
                $kernel->call('key:generate');
            } catch (Exception $exception) {
                info($exception->getMessage());
            }

            do_action(BACKUP_ACTION_AFTER_RESTORE, BACKUP_MODULE_SCREEN_NAME, $request);
            info('Restore backup completed!');

            return $response->setMessage(trans('plugins/backup::backup.restore_backup_success'));
        } catch (Exception $ex) {
            return $response
                ->setError()
                ->setMessage($ex->getMessage());
        }
    }

    /**
     * @param string $folder
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|boolean
     *
     */
    public function getDownloadDatabase($folder)
    {
        $path = storage_path('app/backup/') . $folder;
        foreach (scan_folder($path) as $file) {
            if (Str::contains(basename($file), 'database')) {
                return response()->download($path . DIRECTORY_SEPARATOR . $file);
            }
        }

        return true;
    }

    /**
     * @param string $folder
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|boolean
     *
     */
    public function getDownloadUploadFolder($folder)
    {
        $path = storage_path('app/backup/') . $folder;
        foreach (scan_folder($path) as $file) {
            if (Str::contains(basename($file), 'uploads')) {
                return response()->download($path . DIRECTORY_SEPARATOR . $file);
            }
        }

        return true;
    }
}
