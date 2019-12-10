<?php

namespace Botble\Base\Supports;

use Auth;
use Eloquent;
use Exception;
use File;
use Illuminate\Database\Eloquent\Model;
use Request;

class Helper
{
    /**
     * Load module's helpers
     * @param $directory
     *
     * @since 2.0
     */
    public static function autoload($directory)
    {
        $helpers = File::glob($directory . '/*.php');
        foreach ($helpers as $helper) {
            File::requireOnce($helper);
        }
    }

    /**
     * @param Eloquent | Model $object
     * @param string $session_name
     * @return bool
     *
     */
    public static function handleViewCount(Eloquent $object, $session_name)
    {
        $blank_array = [];
        if (!array_key_exists($object->id, session()->get($session_name, $blank_array))) {
            try {
                $object->increment('views');
                session()->put($session_name . '.' . $object->id, time());
                return true;
            } catch (Exception $ex) {
                return false;
            }
        }

        return false;
    }

    /**
     * Format Log data
     *
     * @param array $input
     * @param string $line
     * @param string $function
     * @param string $class
     * @return array
     *
     */
    public static function formatLog($input, $line = '', $function = '', $class = '')
    {
        return array_merge($input, [
            'user_id'   => Auth::check() ? Auth::user()->getKey() : 'System',
            'ip'        => Request::ip(),
            'line'      => $line,
            'function'  => $function,
            'class'     => $class,
            'userAgent' => Request::header('User-Agent'),
        ]);
    }

    /**
     * @param $plugin
     *
     * @return boolean
     * @since 3.3
     */
    public static function removePluginData($plugin)
    {
        $folders = [
            public_path('vendor/core/plugins/' . $plugin),
            resource_path('assets/plugins/' . $plugin),
            resource_path('views/vendor/plugins.' . $plugin),
            resource_path('lang/vendor/plugins.' . $plugin),
            config_path('plugins.' . $plugin),
        ];

        foreach ($folders as $folder) {
            if (File::isDirectory($folder)) {
                File::deleteDirectory($folder);
            }
        }

        return true;
    }
}
