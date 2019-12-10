<?php

namespace Botble\Gallery\Providers;

use Illuminate\Routing\Events\RouteMatched;
use Botble\Base\Supports\Helper;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Gallery\Facades\GalleryFacade;
use Botble\Gallery\Models\Gallery;
use Botble\Gallery\Models\GalleryMeta;
use Botble\Gallery\Repositories\Caches\GalleryMetaCacheDecorator;
use Botble\Gallery\Repositories\Eloquent\GalleryMetaRepository;
use Botble\Gallery\Repositories\Interfaces\GalleryMetaInterface;
use Event;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Botble\Gallery\Repositories\Caches\GalleryCacheDecorator;
use Botble\Gallery\Repositories\Eloquent\GalleryRepository;
use Botble\Gallery\Repositories\Interfaces\GalleryInterface;
use Language;
use SeoHelper;

class GalleryServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     *
     */
    public function register()
    {
        $this->app->bind(GalleryInterface::class, function () {
            return new GalleryCacheDecorator(
                new GalleryRepository(new Gallery)
            );
        });

        $this->app->bind(GalleryMetaInterface::class, function () {
            return new GalleryMetaCacheDecorator(
                new GalleryMetaRepository(new GalleryMeta)
            );
        });

        Helper::autoload(__DIR__ . '/../../helpers');

        AliasLoader::getInstance()->alias('Gallery', GalleryFacade::class);
    }

    /**
     *
     */
    public function boot()
    {
        $this->setNamespace('plugins/gallery')
            ->loadAndPublishConfigurations(['general', 'permissions'])
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadMigrations()
            ->publishAssetsFolder()
            ->publishPublicFolder();

        $this->app->register(HookServiceProvider::class);
        $this->app->register(EventServiceProvider::class);

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-gallery', // key of menu, it should unique
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => 'plugins/gallery::gallery.menu_name', // menu name, if you don't need translation, you can use the name in plain text
                'icon'        => 'fa fa-camera',
                'url'         => route('galleries.list'),
                'permissions' => ['galleries.list'], // permission should same with route name, you can see that flag in Plugin.php
            ]);
        });

        if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
            Language::registerModule([GALLERY_MODULE_SCREEN_NAME]);
        }

        $this->app->booted(function () {
            config(['packages.slug.general.supported' => array_merge(config('packages.slug.general.supported'), [GALLERY_MODULE_SCREEN_NAME])]);

            config(['packages.slug.general.prefixes.' . GALLERY_MODULE_SCREEN_NAME => 'gallery']);

            SeoHelper::registerModule([GALLERY_MODULE_SCREEN_NAME]);
        });
    }
}
