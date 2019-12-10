<?php

namespace Botble\Menu\Providers;

use Botble\Base\Supports\Helper;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Menu\Facades\MenuFacade;
use Botble\Menu\Models\Menu as MenuModel;
use Botble\Menu\Models\MenuLocation;
use Botble\Menu\Models\MenuNode;
use Botble\Menu\Repositories\Caches\MenuCacheDecorator;
use Botble\Menu\Repositories\Caches\MenuLocationCacheDecorator;
use Botble\Menu\Repositories\Caches\MenuNodeCacheDecorator;
use Botble\Menu\Repositories\Eloquent\MenuLocationRepository;
use Botble\Menu\Repositories\Eloquent\MenuNodeRepository;
use Botble\Menu\Repositories\Eloquent\MenuRepository;
use Botble\Menu\Repositories\Interfaces\MenuInterface;
use Botble\Menu\Repositories\Interfaces\MenuLocationInterface;
use Botble\Menu\Repositories\Interfaces\MenuNodeInterface;
use Event;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Register the service provider.
     *
     * @return void
     *
     */
    public function register()
    {
        AliasLoader::getInstance()->alias('Menu', MenuFacade::class);

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    /**
     * Boot the service provider.
     *
     */
    public function boot()
    {
        $this->app->bind(MenuInterface::class, function () {
            return new MenuCacheDecorator(
                new MenuRepository(new MenuModel)
            );
        });

        $this->app->bind(MenuNodeInterface::class, function () {
            return new MenuNodeCacheDecorator(
                new MenuNodeRepository(new MenuNode)
            );
        });

        $this->app->bind(MenuLocationInterface::class, function () {
            return new MenuLocationCacheDecorator(
                new MenuLocationRepository(new MenuLocation)
            );
        });

        $this->setNamespace('packages/menu')
            ->loadAndPublishConfigurations(['permissions', 'general'])
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadMigrations()
            ->publishAssetsFolder()
            ->publishPublicFolder();

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()
                ->registerItem([
                    'id'          => 'cms-core-menu',
                    'priority'    => 2,
                    'parent_id'   => 'cms-core-appearance',
                    'name'        => 'core/base::layouts.menu',
                    'icon'        => null,
                    'url'         => route('menus.list'),
                    'permissions' => ['menus.list'],
                ]);

            admin_bar()->registerLink('Menu', route('menus.list'), 'appearance');
        });
    }
}
