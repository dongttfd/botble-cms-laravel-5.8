<?php

namespace Botble\ACL\Http\Middleware;

use Closure;
use DashboardMenu;
use Illuminate\Auth\Middleware\Authenticate as BaseAuthenticate;
use Illuminate\Support\Arr;

class Authenticate extends BaseAuthenticate
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Closure $next
     * @param array $guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        if (!$guards) {
            $route = $request->route()->getAction();
            $flag = Arr::get($route, 'permission', Arr::get($route, 'as'));

            if ($flag && !$request->user()->hasAnyPermission((array)$flag)) {
                if ($request->expectsJson()) {
                    return response()->json(['message' => 'Unauthenticated.'], 401);
                }
                return redirect()->route('dashboard.index');
            }

            DashboardMenu::init($request->user());
        }

        return $next($request);
    }
}
