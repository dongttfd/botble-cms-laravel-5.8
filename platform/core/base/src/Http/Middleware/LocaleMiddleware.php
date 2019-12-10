<?php

namespace Botble\Base\Http\Middleware;

use Assets;
use Closure;

class LocaleMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     *
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        app()->setLocale(env('APP_LOCALE', config('app.locale')));

        if ($request->is(config('core.base.general.admin_dir') . '/*') ||
            $request->is(config('core.base.general.admin_dir'))
        ) {
            if ($request->session()->has('admin-locale') &&
                array_key_exists($request->session()->get('admin-locale'), Assets::getAdminLocales())
            ) {
                app()->setLocale($request->session()->get('admin-locale'));
                $request->setLocale($request->session()->get('admin-locale'));
            }
        }

        return $next($request);
    }
}
