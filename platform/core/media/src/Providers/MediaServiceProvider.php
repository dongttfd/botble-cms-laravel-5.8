<?php

namespace Botble\Media\Providers;

use Botble\Base\Supports\Helper;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Media\Facades\RvMediaFacade;
use Botble\Media\Models\MediaFile;
use Botble\Media\Models\MediaFolder;
use Botble\Media\Models\MediaSetting;
use Botble\Media\Repositories\Caches\MediaFileCacheDecorator;
use Botble\Media\Repositories\Caches\MediaFolderCacheDecorator;
use Botble\Media\Repositories\Caches\MediaSettingCacheDecorator;
use Botble\Media\Repositories\Eloquent\MediaFileRepository;
use Botble\Media\Repositories\Eloquent\MediaFolderRepository;
use Botble\Media\Repositories\Eloquent\MediaSettingRepository;
use Botble\Media\Repositories\Interfaces\MediaFileInterface;
use Botble\Media\Repositories\Interfaces\MediaFolderInterface;
use Botble\Media\Repositories\Interfaces\MediaSettingInterface;
use Event;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\ServiceProvider;

/**
 * Class MediaServiceProvider
 * @package Botble\Media
 *
 * @since 02/07/2016 09:50 AM
 */
class MediaServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    public function register()
    {
        $this->app->bind(MediaFileInterface::class, function () {
            return new MediaFileCacheDecorator(
                new MediaFileRepository(new MediaFile)
            );
        });

        $this->app->bind(MediaFolderInterface::class, function () {
            return new MediaFolderCacheDecorator(
                new MediaFolderRepository(new MediaFolder)
            );
        });

        $this->app->bind(MediaSettingInterface::class, function () {
            return new MediaSettingCacheDecorator(
                new MediaSettingRepository(new MediaSetting)
            );
        });

        Helper::autoload(__DIR__ . '/../../helpers');

        AliasLoader::getInstance()->alias('RvMedia', RvMediaFacade::class);
    }

    /**
     * Boot the service provider.
     *
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/media.php', 'media');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'media');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'media');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->setNamespace('core/media')
            ->loadAndPublishConfigurations(['permissions']);

        if ($this->app->runningInConsole()) {
            $this->loadMigrations();

            $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/media')], 'cms-views');
            $this->publishes([__DIR__ . '/../../resources/lang' => resource_path('lang/vendor/media')], 'cms-lang');
            $this->publishes([__DIR__ . '/../../config/media.php' => config_path('media.php')], 'cms-config');
            $this->publishes([__DIR__ . '/../../resources/assets' => resource_path('assets/core/media')], 'cms-assets');
            $this->publishes([__DIR__ . '/../../public' => public_path('vendor/core/media')], 'cms-public');
        }

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-core-media',
                'priority'    => 995,
                'parent_id'   => null,
                'name'        => 'media::media.menu_name',
                'icon'        => 'far fa-images',
                'url'         => route('media.index'),
                'permissions' => ['media.index'],
            ]);
        });

        config(['media.driver.s3.path' => setting('media_aws_url', config('filesystems.disks.s3.url'))]);
    }
}
