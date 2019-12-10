<?php

namespace Botble\SocialLogin\Providers;

use Illuminate\Support\ServiceProvider;

class HookServiceProvider extends ServiceProvider
{
    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     *
     */
    public function boot()
    {
        if (setting('social_login_enable', false)) {
            add_filter(BASE_FILTER_AFTER_LOGIN_OR_REGISTER_FORM, [$this, 'addLoginOptions'], 25, 2);
        }
    }

    /**
     * @param $html
     * @param $module
     * @return null|string
     * @throws \Throwable
     *
     */
    public function addLoginOptions($html, $module)
    {
        if ($module === 'core/acl') {
            return $html . view('plugins/social-login::login-options')->render();
        }
        return $html;
    }
}