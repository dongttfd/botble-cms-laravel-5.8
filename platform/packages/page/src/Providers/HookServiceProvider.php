<?php

namespace Botble\Page\Providers;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Dashboard\Supports\DashboardWidgetInstance;
use Botble\Page\Repositories\Interfaces\PageInterface;
use Botble\SeoHelper\SeoOpenGraph;
use Eloquent;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Menu;
use SeoHelper;
use Theme;

class HookServiceProvider extends ServiceProvider
{
    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Boot the service provider.
     *
     */
    public function boot()
    {
        if (defined('MENU_ACTION_SIDEBAR_OPTIONS')) {
            add_action(MENU_ACTION_SIDEBAR_OPTIONS, [$this, 'registerMenuOptions'], 10);
        }
        add_filter(DASHBOARD_FILTER_ADMIN_LIST, [$this, 'addPageStatsWidget'], 15, 2);
        add_filter(BASE_FILTER_PUBLIC_SINGLE_DATA, [$this, 'handleSingleView'], 1, 1);
        add_filter(BASE_FILTER_AFTER_SETTING_CONTENT, [$this, 'addSetting'], 29, 1);
    }

    /**
     * Register sidebar options in menu
     * @throws \Throwable
     */
    public function registerMenuOptions()
    {
        $pages = Menu::generateSelect([
            'model'   => $this->app->make(PageInterface::class)->getModel(),
            'screen'  => PAGE_MODULE_SCREEN_NAME,
            'theme'   => false,
            'options' => [
                'class' => 'list-item',
            ],
        ]);
        echo view('packages/page::partials.menu-options', compact('pages'));
    }

    /**
     * @param array $widgets
     * @param Collection $widget_settings
     * @return array
     *
     * @throws \Throwable
     */
    public function addPageStatsWidget($widgets, $widgetSettings)
    {
        $pages = $this->app->make(PageInterface::class)->count(['status' => BaseStatusEnum::PUBLISHED]);

        $widget = new DashboardWidgetInstance;

        $widget->type = 'stats';
        $widget->permission = 'pages.list';
        $widget->key = 'widget_total_pages';
        $widget->title = trans('packages/page::pages.pages');
        $widget->icon = 'far fa-file-alt';
        $widget->color = '#32c5d2';
        $widget->statsTotal = $pages;
        $widget->route = route('pages.list');

        return $widget->init($widgets, $widgetSettings);
    }

    /**
     * @param Eloquent $slug
     * @return array|Eloquent
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handleSingleView($slug)
    {
        if ($slug instanceof Eloquent) {
            $data = [];
            if ($slug->reference === PAGE_MODULE_SCREEN_NAME) {
                $page = $this->app->make(PageInterface::class)
                    ->getFirstBy([
                        'id'     => $slug->reference_id,
                        'status' => BaseStatusEnum::PUBLISHED,
                    ]);
                if (!empty($page)) {
                    SeoHelper::setTitle($page->name)->setDescription($page->description);

                    $meta = new SeoOpenGraph;
                    if ($page->image) {
                        $meta->setImage(url($page->image));
                    }
                    $meta->setDescription($page->description);
                    $meta->setUrl(route('public.single', $slug->key));
                    $meta->setTitle($page->name);
                    $meta->setType('article');

                    SeoHelper::setSeoOpenGraph($meta);

                    if ($page->template) {
                        Theme::uses(setting('theme'))->layout($page->template);
                    }

                    admin_bar()
                        ->registerLink(trans('packages/page::pages.edit_this_page'), route('pages.edit', $page->id));

                    Theme::breadcrumb()
                        ->add(__('Home'), url('/'))
                        ->add($page->name, route('public.single', $slug));

                    do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, PAGE_MODULE_SCREEN_NAME, $page);

                    $data = [
                        'view'         => 'page',
                        'default_view' => 'packages/page::themes.page',
                        'data'         => compact('page'),
                        'slug'         => $page->slug,
                    ];
                }
                if (!empty($data)) {
                    return $data;
                }
            }
        }

        return $slug;
    }

    /**
     * @param null $data
     * @return string
     * @throws \Throwable
     *
     */
    public function addSetting($data = null)
    {
        $pages = $this->app->make(PageInterface::class)
            ->allBy(['pages.status' => BaseStatusEnum::PUBLISHED], [], ['pages.id', 'pages.name']);

        return $data . view('packages/page::setting', compact('pages'))->render();
    }
}
