<?php

namespace Botble\Page\Providers;

use Botble\Base\Supports\Helper;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Page\Models\Page;
use Botble\Page\Repositories\Caches\PageCacheDecorator;
use Botble\Page\Repositories\Eloquent\PageRepository;
use Botble\Page\Repositories\Interfaces\PageInterface;
use Botble\Shortcode\View\View;
use Event;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\ServiceProvider;

/**
 * Class PageServiceProvider
 * @package Botble\Page
 *
 * @since 02/07/2016 09:50 AM
 */
class PageServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');
    }

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->app->bind(PageInterface::class, function () {
            return new PageCacheDecorator(new PageRepository(new Page));
        });

        $this->setNamespace('packages/page')
            ->loadAndPublishConfigurations(['permissions', 'general'])
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadMigrations();

        $this->app->register(HookServiceProvider::class);
        $this->app->register(EventServiceProvider::class);

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-core-page',
                'priority'    => 2,
                'parent_id'   => null,
                'name'        => 'packages/page::pages.menu_name',
                'icon'        => 'fa fa-book',
                'url'         => route('pages.list'),
                'permissions' => ['pages.list'],
            ]);

            admin_bar()->registerLink('Page', route('pages.list'), 'add-new');
        });

        view()->composer(['packages/page::themes.page'], function (View $view) {
            $view->withShortcodes();
        });
    }
}
