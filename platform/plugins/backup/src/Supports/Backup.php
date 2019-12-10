<?php

namespace Botble\Backup\Supports;

use Carbon\Carbon;
use DB;
use Exception;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use ZipArchive;
use Botble\Base\Supports\PclZip as Zip;
use Illuminate\Filesystem\Filesystem;

class Backup
{

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $file;

    /**
     * @var string
     */
    protected $folder;

    /**
     *
     */
    public function __construct()
    {
        $this->file = new Filesystem();
    }

    /**
     * @param Request $request
     * @return array
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function createBackupFolder(Request $request)
    {
        $backupFolder = $this->createFolder(storage_path('app/backup'));
        $now = Carbon::now(config('app.timezone'))->format('Y-m-d-H-i-s');
        $this->folder = $this->createFolder($backupFolder . DIRECTORY_SEPARATOR . $now);

        $file = storage_path('app/backup/backup.json');
        $data = [];

        if (file_exists($file)) {
            $data = get_file_data($file);
        }

        $data[$now] = [
            'name'        => $request->input('name'),
            'description' => $request->input('description'),
            'date'        => Carbon::now(config('app.timezone'))->toDateTimeString(),
        ];
        save_file_data($file, $data);

        return [
            'key'  => $now,
            'data' => $data[$now],
        ];
    }

    /**
     * @return array|bool|mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getBackupList()
    {
        $file = storage_path('app/backup/backup.json');
        if (file_exists($file)) {
            return get_file_data($file);
        }

        return [];
    }

    /**
     * @param string $folder
     * @return mixed
     *
     */
    public function createFolder($folder)
    {
        if (!$this->file->isDirectory($folder)) {
            $this->file->makeDirectory($folder);
            chmod($folder, 0777);
        }

        return $folder;
    }

    /**
     * @return bool
     *
     * @throws Exception
     */
    public function backupDb()
    {
        $file = 'database-' . Carbon::now(config('app.timezone'))->format('Y-m-d-H-i-s');
        $path = $this->folder . DIRECTORY_SEPARATOR . $file;

        $mysql_path = rtrim(setting('backup_mysql_execute_path', env('BACKUP_MYSQL_EXECUTE_PATH', '')), '/');
        if (!empty($mysql_path)) {
            $mysql_path = $mysql_path . '/';
        }

        $sql = $mysql_path . 'mysqldump --user=' . env('DB_USERNAME') . ' --password=' . env('DB_PASSWORD') . ' --host=' . env('DB_HOST') . ' ' . env('DB_DATABASE') . ' > ' . $path . '.sql';

        system($sql);
        $this->compressFileToZip($path, $file);
        if (file_exists($path . '.zip')) {
            chmod($path . '.zip', 0777);
        }

        return true;
    }

    /**
     * @param string $source
     * @return bool
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function backupFolder($source)
    {
        $file = $this->folder . DIRECTORY_SEPARATOR . 'uploads-' . Carbon::now(config('app.timezone'))->format('Y-m-d-H-i-s') . '.zip';

        // set script timeout value
        ini_set('max_execution_time', 5000);

        if (class_exists('ZipArchive', false)) {
            $zip = new ZipArchive();
            // create and open the archive
            if ($zip->open($file, ZipArchive::CREATE) !== true) {
                $this->deleteFolderBackup($this->folder);
            }
        } else {
            $zip = new Zip($file);
        }
        $arr_src = explode(DIRECTORY_SEPARATOR, $source);
        $path_length = strlen(implode(DIRECTORY_SEPARATOR, $arr_src) . DIRECTORY_SEPARATOR);
        // add each file in the file list to the archive
        $this->recurseZip($source, $zip, $path_length);
        if (class_exists('ZipArchive', false)) {
            $zip->close();
        }
        if (file_exists($file)) {
            chmod($file, 0777);
        }

        return true;
    }

    /**
     * @param string $path
     * @param string $file
     * @return bool
     *
     * @throws Exception
     */
    public function restoreDb($file, $path)
    {
        $this->restore($file, $path);
        $file = $path . DIRECTORY_SEPARATOR . File::name($file) . '.sql';

        if (!file_exists($file)) {
            return false;
        }
        // Force the new login to be used
        DB::purge();
        DB::unprepared('USE `' . env('DB_DATABASE') . '`');
        DB::connection()->setDatabaseName(env('DB_DATABASE'));
        DB::unprepared(file_get_contents($file));

        $this->deleteFile($file);

        return true;
    }

    /**
     * @param string $fileName
     * @param string $pathTo
     * @return bool
     *
     */
    public function restore($fileName, $pathTo)
    {
        if (class_exists('ZipArchive', false)) {
            $zip = new ZipArchive;
            if ($zip->open($fileName) === true) {
                $zip->extractTo($pathTo);
                $zip->close();
                return true;
            }
        } else {
            $archive = new Zip($fileName);
            $archive->extract(PCLZIP_OPT_PATH, $pathTo, PCLZIP_OPT_REMOVE_ALL_PATH);
            return true;
        }

        return false;
    }

    /**
     * @param string $src
     * @param ZipArchive $zip
     * @param string $pathLength
     *
     */
    public function recurseZip($src, &$zip, $pathLength)
    {
        foreach (scan_folder($src) as $file) {
            if ($this->file->isDirectory($src . DIRECTORY_SEPARATOR . $file)) {
                $this->recurseZip($src . DIRECTORY_SEPARATOR . $file, $zip, $pathLength);
            } else {
                if (class_exists('ZipArchive', false)) {
                    /**
                     * @var ZipArchive $zip
                     */
                    $zip->addFile($src . DIRECTORY_SEPARATOR . $file, substr($src . DIRECTORY_SEPARATOR . $file, $pathLength));
                } else {
                    /**
                     * @var Zip $zip
                     */
                    $zip->add($src . DIRECTORY_SEPARATOR . $file, PCLZIP_OPT_REMOVE_PATH, substr($src . DIRECTORY_SEPARATOR . $file, $pathLength));
                }
            }
        }
    }

    /**
     * @param string $path
     * @param string $name
     *
     * @throws Exception
     */
    public function compressFileToZip($path, $name)
    {
        $filename = $path . '.zip';

        if (class_exists('ZipArchive', false)) {
            $zip = new ZipArchive();
            if ($zip->open($filename, ZipArchive::CREATE) == true) {
                $zip->addFile($path . '.sql', $name . '.sql');
                $zip->close();
            }
        } else {
            $archive = new Zip($filename);
            $archive->add($path . '.sql', PCLZIP_OPT_REMOVE_PATH, $filename);
        }
        $this->deleteFile($path . '.sql');
    }

    /**
     * @param string $file
     * @throws Exception
     *
     */
    public function deleteFile($file)
    {
        if ($this->file->exists($file)) {
            $this->file->delete($file);
        }
    }

    /**
     * @param string $path
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function deleteFolderBackup($path)
    {
        if (File::isDirectory(storage_path('app/backup')) && File::isDirectory($path)) {
            foreach (scan_folder($path) as $item) {
                $this->file->delete($path . DIRECTORY_SEPARATOR . $item);
            }
            $this->file->deleteDirectory($path);

            if (empty($this->file->directories(storage_path('app/backup')))) {
                $this->file->deleteDirectory(storage_path('app/backup'));
            }
        }

        $file = storage_path('app/backup/backup.json');
        $data = [];
        if (file_exists($file)) {
            $data = get_file_data($file);
        }
        if (!empty($data)) {
            unset($data[Arr::last(explode('/', $path))]);
            save_file_data($file, $data);
        }
    }
}
