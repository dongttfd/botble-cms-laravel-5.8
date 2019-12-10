<?php

namespace Botble\Theme\Commands\Traits;

/**
 * Trait ThemeTrait
 * @package Botble\Theme\Commands\Traits
 * @mixin \Illuminate\Console\Command
 */
trait ThemeTrait
{
    /**
     * Get the theme name.
     *
     * @return string
     */
    protected function getTheme()
    {
        return strtolower($this->argument('name'));
    }

    /**
     * Get root writable path.
     *
     * @param  string $path
     * @return string
     */
    protected function getPath($path)
    {
        $rootPath = theme_path();
        if ($this->option('path')) {
            $rootPath = $this->option('path');
        }

        return rtrim($rootPath, '/') . '/' . rtrim(ltrim(strtolower($this->getTheme()), '/'), '/') . '/' . $path;
    }
}