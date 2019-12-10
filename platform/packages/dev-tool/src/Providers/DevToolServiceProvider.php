<?php

namespace Botble\DevTool\Providers;

use Illuminate\Support\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;

class DevToolServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    public function register()
    {
    }

    public function boot()
    {
        $this->setNamespace('packages/dev-tool');

        $this->app->register(CommandServiceProvider::class);
    }
}
