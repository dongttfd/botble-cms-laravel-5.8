<?php

namespace Botble\Theme\Providers;

use Botble\Base\Supports\Helper;
use Illuminate\Support\ServiceProvider;

class ThemeManagementServiceProvider extends ServiceProvider
{
    /**
     *
     */
    public function boot()
    {
        $theme = setting('theme');
        if (check_database_connection() && !empty($theme)) {
            $this->app->make('translator')->addJsonPath(theme_path($theme . '/lang'));

            Helper::autoload(theme_path($theme . '/functions'));
        }
    }
}
