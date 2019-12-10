<?php

namespace Botble\Base\Supports;

use App;
use Illuminate\Support\Arr;

class SystemManagement
{

    /**
     * @var array
     */
    public static $systemExtras = [];

    /**
     * @var array
     */
    public static $serverExtras = [];

    /**
     * @var array
     */
    public static $extraStats = [];

    /**
     * Get the De-composer system report as a PHP array
     * @return array
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function getReportArray()
    {
        $composerArray = self::getComposerArray();
        $reportArray['Server Environment'] = self::getServerEnv();
        $reportArray['System Environment'] = self::getSystemEnv();
        $reportArray['Installed Packages'] = self::getPackagesArray($composerArray['require']);

        if (self::getExtraStats()) {
            $reportArray['Extra Stats'] = self::getExtraStats();
        }

        return $reportArray;
    }

    /**
     * Add Extra stats by app or any other package dev
     * @param $extraStatsArray
     */
    public static function addExtraStats(array $extraStatsArray)
    {
        self::$extraStats = array_merge(self::$extraStats, $extraStatsArray);
    }

    /**
     * Add System specific stats by app or any other package dev
     * @param $serverStatsArray
     */
    public static function addSystemStats(array $systemStatsArray)
    {
        self::$systemExtras = array_merge(self::$systemExtras, $systemStatsArray);
    }


    /**
     * Add Server specific stats by app or any other package dev
     * @param $serverStatsArray
     */
    public static function addServerStats(array $serverStatsArray)
    {
        self::$serverExtras = array_merge(self::$serverExtras, $serverStatsArray);
    }

    /**
     * Get the extra stats added by the app or any other package dev
     * @return array
     */
    public static function getExtraStats()
    {
        return self::$extraStats;
    }

    /**
     * Get additional server info added by the app or any other package dev
     * @return array
     */
    public static function getServerExtras()
    {
        return self::$serverExtras;
    }

    /**
     * Get additional system info added by the app or any other package dev
     * @return array
     */
    public static function getSystemExtras()
    {
        return self::$systemExtras;
    }

    /**
     * Get the system report as JSON
     *
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function getReportJson()
    {
        return json_encode(self::getReportArray());
    }

    /**
     * Get the Composer file contents as an array
     * @return array
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function getComposerArray()
    {
        return get_file_data(base_path('composer.json'));
    }

    /**
     * Get Installed packages & their Dependencies
     *
     * @param $packagesArray
     * @return array
     */
    public static function getPackagesAndDependencies($packagesArray)
    {
        $packages = [];
        foreach ($packagesArray as $key => $value) {
            $packageFile = base_path('/vendor/' . $key . '/composer.json');

            if ($key !== 'php' && file_exists($packageFile)) {
                $json2 = file_get_contents($packageFile);
                $dependenciesArray = json_decode($json2, true);
                $dependencies = array_key_exists('require', $dependenciesArray) ?
                    $dependenciesArray['require'] : 'No dependencies';
                $devDependencies = array_key_exists('require-dev', $dependenciesArray) ?
                    $dependenciesArray['require-dev'] : 'No dependencies';

                $packages[] = [
                    'name'             => $key,
                    'version'          => $value,
                    'dependencies'     => $dependencies,
                    'dev-dependencies' => $devDependencies,
                ];
            }
        }

        return $packages;
    }

    /**
     * Get System environment details
     *
     * @return array
     */
    public static function getSystemEnv()
    {
        return array_merge([
            'version'              => App::version(),
            'timezone'             => config('app.timezone'),
            'debug_mode'           => config('app.debug'),
            'storage_dir_writable' => is_writable(base_path('storage')),
            'cache_dir_writable'   => is_writable(base_path('bootstrap/cache')),
            'app_size'             => human_file_size(self::folderSize(base_path())),
        ], self::getSystemExtras());
    }

    /**
     * Get PHP/Server environment details
     * @return array
     */
    public static function getServerEnv()
    {
        return array_merge([
            'version'                  => phpversion(),
            'server_software'          => Arr::get($_SERVER, 'SERVER_SOFTWARE'),
            'server_os'                => php_uname(),
            'database_connection_name' => config('database.default'),
            'ssl_installed'            => self::checkSslIsInstalled(),
            'cache_driver'             => config('cache.default'),
            'session_driver'           => config('session.driver'),
            'mbstring'                 => extension_loaded('mbstring'),
            'openssl'                  => extension_loaded('openssl'),
            'curl'                     => extension_loaded('curl'),
            'exif'                     => extension_loaded('exif'),
            'pdo'                      => extension_loaded('pdo'),
            'fileinfo'                 => extension_loaded('fileinfo'),
            'tokenizer'                => extension_loaded('tokenizer'),
        ], self::getServerExtras());
    }

    /**
     * Get Installed packages & their version numbers as an associative array
     *
     * @param $packagesArray
     * @return array
     */
    protected static function getPackagesArray($composerRequireArray)
    {
        $packagesArray = self::getPackagesAndDependencies($composerRequireArray);

        $packages = [];
        foreach ($packagesArray as $packageArray) {
            $packages[$packageArray['name']] = $packageArray['version'];
        }

        return $packages;
    }

    /**
     * Check if SSL is installed or not
     * @return boolean
     */
    protected static function checkSslIsInstalled()
    {
        return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? true : false;
    }

    /**
     * Get the system app's size
     *
     * @param $dir
     * @return int
     */
    protected static function folderSize($dir)
    {
        $size = 0;
        foreach (glob(rtrim($dir, '/') . '/*', GLOB_NOSORT) as $each) {
            $size += is_file($each) ? filesize($each) : self::folderSize($each);
        }
        return $size;
    }
}
