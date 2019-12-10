<?php

use Botble\Theme\Facades\ThemeOptionFacade;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

if (!function_exists('theme')) {
    /**
     * Get the theme instance.
     *
     * @param  string $themeName
     * @param  string $layoutName
     * @return Theme
     * @throws FileNotFoundException
     */
    function theme($themeName = null, $layoutName = null)
    {
        $theme = app('theme');

        if ($themeName) {
            $theme->theme($themeName);
        }

        if ($layoutName) {
            $theme->layout($layoutName);
        }
        return $theme;
    }
}

if (!function_exists('theme_option')) {
    /**
     * @return mixed
     *
     */
    function theme_option($key = null, $default = null)
    {
        if (!empty($key)) {
            try {
                return ThemeOption::getOption($key, $default);
            } catch (FileNotFoundException $exception) {
                info($exception->getMessage());
            }
        }

        return ThemeOptionFacade::getFacadeRoot();
    }
}

if (!function_exists('theme_path')) {
    /**
     * @return string
     *
     */
    function theme_path($path = null)
    {
        return platform_path('themes' . DIRECTORY_SEPARATOR . $path);
    }
}
