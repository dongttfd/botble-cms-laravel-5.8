<?php

namespace Botble\Captcha\Providers;

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
        add_filter(BASE_FILTER_AFTER_SETTING_CONTENT, [$this, 'addSettings'], 299, 1);
    }

    /**
     * @param null $data
     * @return string
     * @throws \Throwable
     *
     */
    public function addSettings($data = null)
    {
        return $data . view('plugins/captcha::setting')->render();
    }
}
