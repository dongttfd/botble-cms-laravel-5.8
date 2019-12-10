<?php

namespace Botble\Base\Providers;

use Botble\Base\Exceptions\Handler;
use Botble\Base\Http\Middleware\AdminBarMiddleware;
use Botble\Base\Http\Middleware\DisableInDemoModeMiddleware;
use Botble\Base\Http\Middleware\HttpsProtocolMiddleware;
use Botble\Base\Http\Middleware\LocaleMiddleware;
use Botble\Base\Models\MetaBox as MetaBoxModel;
use Botble\Base\Repositories\Caches\MetaBoxCacheDecorator;
use Botble\Base\Repositories\Eloquent\MetaBoxRepository;
use Botble\Base\Repositories\Interfaces\MetaBoxInterface;
use Botble\Base\Supports\Helper;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Setting\Providers\SettingServiceProvider;
use Botble\Setting\Supports\SettingStore;
use Event;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use MetaBox;
use Schema;

class BaseServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Register any application services.
     *
     * @return void
     * 
     */
    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

        $this->setNamespace('core/base')
            ->loadAndPublishConfigurations(['general']);

        $this->app->register(SettingServiceProvider::class);

        $config = $this->app->make('config');
        $setting = $this->app->make(SettingStore::class);

        $config->set([
            'app.timezone'                     => $setting->get('time_zone', $config->get('app.timezone')),
            'jsvalidation.view'                => 'jsvalidation::bootstrap4',
            'ziggy.blacklist'                  => ['debugbar.*'],
            'session.cookie'                   => 'botble_session',
            'filesystems.default'              => $setting->get('media_driver', $config->get('filesystems.default')),
            'filesystems.disks.s3.key'         => $setting
                ->get('media_aws_access_key_id', $config->get('filesystems.disks.s3.key')),
            'filesystems.disks.s3.secret'      => $setting
                ->get('media_aws_secret_key', $config->get('filesystems.disks.s3.secret')),
            'filesystems.disks.s3.region'      => $setting
                ->get('media_aws_default_region', $config->get('filesystems.disks.s3.region')),
            'filesystems.disks.s3.bucket'      => $setting
                ->get('media_aws_bucket', $config->get('filesystems.disks.s3.bucket')),
            'filesystems.disks.s3.url'         => $setting
                ->get('media_aws_url', $config->get('filesystems.disks.s3.url')),
            'app.debug_blacklist'              => [
                '_ENV'    => [
                    'APP_KEY',
                    'ADMIN_DIR',
                    'DB_DATABASE',
                    'DB_USERNAME',
                    'DB_PASSWORD',
                    'REDIS_PASSWORD',
                    'MAIL_PASSWORD',
                    'PUSHER_APP_KEY',
                    'PUSHER_APP_SECRET',
                ],
                '_SERVER' => [
                    'APP_KEY',
                    'ADMIN_DIR',
                    'DB_DATABASE',
                    'DB_USERNAME',
                    'DB_PASSWORD',
                    'REDIS_PASSWORD',
                    'MAIL_PASSWORD',
                    'PUSHER_APP_KEY',
                    'PUSHER_APP_SECRET',
                ],
                '_POST'   => [
                    'password',
                ],
            ],
            'datatables-buttons.pdf_generator' => 'excel',
        ]);

        $this->app->singleton(ExceptionHandler::class, Handler::class);

        /**
         * @var Router $router
         */
        $router = $this->app['router'];

        $router->pushMiddlewareToGroup('web', LocaleMiddleware::class);
        $router->pushMiddlewareToGroup('web', HttpsProtocolMiddleware::class);
        $router->pushMiddlewareToGroup('web', AdminBarMiddleware::class);
        $router->aliasMiddleware('preventDemo', DisableInDemoModeMiddleware::class);

        $this->app->bind(MetaBoxInterface::class, function () {
            return new MetaBoxCacheDecorator(new MetaBoxRepository(new MetaBoxModel));
        });

        $this->app->register(PluginServiceProvider::class);
    }

    /**
     * Boot the service provider.
     * @return void
     * 
     */
    public function boot()
    {
        $this->setNamespace('core/base')
            ->loadAndPublishConfigurations(['permissions', 'assets'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadMigrations()
            ->publishAssetsFolder()
            ->publishPublicFolder();

        Schema::defaultStringLength(191);

        $this->app->booted(function () {
            do_action('init');
            add_action(BASE_ACTION_META_BOXES, [MetaBox::class, 'doMetaBoxes'], 8, 3);

            $this->app->make('config')->set([
                'app.locale' => env('APP_LOCALE', $this->app->make('config')->get('app.locale')),
            ]);
        });

        Event::listen(RouteMatched::class, function () {
            $this->registerDefaultMenus();
        });
    }

    /**
     * Add default dashboard menu for core
     * 
     */
    public function registerDefaultMenus()
    {
        dashboard_menu()
            ->registerItem([
                'id'          => 'cms-core-plugins',
                'priority'    => 997,
                'parent_id'   => null,
                'name'        => 'core/base::layouts.plugins',
                'icon'        => 'fa fa-plug',
                'url'         => route('plugins.list'),
                'permissions' => ['plugins.list'],
            ])
            ->registerItem([
                'id'          => 'cms-core-platform-administration',
                'priority'    => 999,
                'parent_id'   => null,
                'name'        => 'core/base::layouts.platform_admin',
                'icon'        => 'fa fa-user-shield',
                'url'         => null,
                'permissions' => ['users.list'],
            ])
            ->registerItem([
                'id'          => 'cms-core-system-information',
                'priority'    => 5,
                'parent_id'   => 'cms-core-platform-administration',
                'name'        => 'core/base::system.info.title',
                'icon'        => null,
                'url'         => route('system.info'),
                'permissions' => ['superuser'],
            ])
            ->registerItem([
                'id'          => 'cms-core-system-cache',
                'priority'    => 6,
                'parent_id'   => 'cms-core-platform-administration',
                'name'        => 'core/base::cache.cache_management',
                'icon'        => null,
                'url'         => route('system.cache'),
                'permissions' => ['superuser'],
            ]);
    }
}
