<?php

namespace Botble\Optimize\Providers;

use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Optimize\Http\Middleware\CollapseWhitespace;
use Botble\Optimize\Http\Middleware\ElideAttributes;
use Botble\Optimize\Http\Middleware\InlineCss;
use Botble\Optimize\Http\Middleware\InsertDNSPrefetch;
use Botble\Optimize\Http\Middleware\RemoveComments;
use Event;
use File;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Silber\PageCache\Middleware\CacheResponse;

class OptimizeServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     *
     */
    public function boot()
    {
        $this->setNamespace('packages/optimize')
            ->loadAndPublishConfigurations(['general'])
            ->loadAndPublishTranslations()
            ->loadAndPublishViews();

        $this->app->register(HookServiceProvider::class);

        /**
         * @var Router $router
         */
        $router = $this->app['router'];

        $router->pushMiddlewareToGroup('web', ElideAttributes::class);
        $router->pushMiddlewareToGroup('web', InsertDNSPrefetch::class);
        if (!$this->app->isLocal() && !is_in_admin()) {
            $router->pushMiddlewareToGroup('web', CollapseWhitespace::class);
        }
        $router->pushMiddlewareToGroup('web', RemoveComments::class);
        $router->pushMiddlewareToGroup('web', InlineCss::class);

        if (env('OPTIMIZE_ENABLE_CACHE_RESPONSE', false)) {
            $router->pushMiddlewareToGroup('web', CacheResponse::class);
        }

        Event::listen(['cache:cleared'], function () {
            File::deleteDirectory(public_path('page-cache'));
        });
    }
}
