<?php

namespace Botble\RequestLog\Providers;

use Illuminate\Routing\Events\RouteMatched;
use Botble\Base\Supports\Helper;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\RequestLog\Repositories\Caches\RequestLogCacheDecorator;
use Botble\RequestLog\Repositories\Eloquent\RequestLogRepository;
use Botble\RequestLog\Repositories\Interfaces\RequestLogInterface;
use Event;
use Illuminate\Support\ServiceProvider;
use Botble\RequestLog\Models\RequestLog as RequestLogModel;

/**
 * Class RequestLogServiceProvider
 * @package Botble\RequestLog
 * @since 02/07/2016 09:50 AM
 */
class RequestLogServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    public function register()
    {
        $this->app->bind(RequestLogInterface::class, function () {
            return new RequestLogCacheDecorator(new RequestLogRepository(new RequestLogModel));
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->app->register(EventServiceProvider::class);
        $this->app->register(CommandServiceProvider::class);

        $this->setNamespace('plugins/request-log')
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->publishPublicFolder()
            ->publishAssetsFolder();

        $this->app->register(HookServiceProvider::class);

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()
                ->registerItem([
                    'id'          => 'cms-plugin-request-log',
                    'priority'    => 8,
                    'parent_id'   => 'cms-core-platform-administration',
                    'name'        => 'plugins/request-log::request-log.name',
                    'icon'        => null,
                    'url'         => route('request-log.list'),
                    'permissions' => ['request-log.list'],
                ]);
        });
    }
}
