<?php

namespace Botble\Base\Providers;

use Assets;
use Auth;
use Botble\ACL\Models\UserMeta;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;
use RvMedia;

class ComposerServiceProvider extends ServiceProvider
{

    /**
     *
     * @param Factory $view
     */
    public function boot(Factory $view)
    {
        $view->composer(['core/base::layouts.partials.top-header'], function (View $view) {
            $themes = Assets::getThemes();
            $locales = Assets::getAdminLocales();

            if (Auth::check() && !session()->has('admin-theme')) {
                $active_theme = UserMeta::getMeta('admin-theme', config('core.base.general.default-theme'));
            } elseif (session()->has('admin-theme')) {
                $active_theme = session('admin-theme');
            } else {
                $active_theme = config('core.base.general.default-theme');
            }

            if (!array_key_exists($active_theme, $themes)) {
                $active_theme = config('core.base.general.default-theme');
            }

            if (array_key_exists($active_theme, $themes)) {
                Assets::addStylesDirectly($themes[$active_theme]);
            }

            session(['admin-theme' => $active_theme]);

            $view->with(compact('themes', 'locales', 'active_theme'));
        });

        $view->composer(['core/acl::auth.master'], function (View $view) {
            $themes = Assets::getThemes();
            $active_theme = config('core.base.general.default-theme');

            if (array_key_exists($active_theme, $themes)) {
                Assets::addStylesDirectly($themes[$active_theme]);
            }

            $view->with(compact('themes', 'active_theme'));
        });

        $view->composer(['media::config'], function () {
            $mediaPermissions = config('media.permissions');
            if (Auth::check() && !Auth::user()->isSuperUser()) {
                $mediaPermissions = array_intersect(array_keys(Auth::user()->permissions), config('media.permissions'));
            }
            RvMedia::setPermissions($mediaPermissions);
        });
    }
}
