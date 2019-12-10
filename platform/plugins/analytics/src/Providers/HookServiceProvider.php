<?php

namespace Botble\Analytics\Providers;

use Assets;
use Auth;
use Botble\Dashboard\Supports\DashboardWidgetInstance;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class HookServiceProvider extends ServiceProvider
{
    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Bootstrap the application events.
     *
     */
    public function boot()
    {
        if (env('ANALYTICS_ENABLE_DASHBOARD_WIDGETS', true)) {
            add_action(DASHBOARD_ACTION_REGISTER_SCRIPTS, [$this, 'registerScripts'], 18);
            add_filter(DASHBOARD_FILTER_ADMIN_LIST, [$this, 'addGeneralWidget'], 18, 2);
            add_filter(DASHBOARD_FILTER_ADMIN_LIST, [$this, 'addPageWidget'], 19, 2);
            add_filter(DASHBOARD_FILTER_ADMIN_LIST, [$this, 'addBrowserWidget'], 20, 2);
            add_filter(DASHBOARD_FILTER_ADMIN_LIST, [$this, 'addReferrerWidget'], 22, 2);
            add_filter(BASE_FILTER_AFTER_SETTING_CONTENT, [$this, 'addAnalyticsSetting'], 99, 1);
        }
    }

    /**
     * @return void
     *
     */
    public function registerScripts()
    {
        if (Auth::user()->hasAnyPermission([
            'analytics.general',
            'analytics.page',
            'analytics.browser',
            'analytics.referrer',
        ])) {
            Assets::addScripts(['jvectormap', 'raphael', 'morris'])
                ->addStyles(['jvectormap', 'morris'])
                ->addScriptsDirectly([
                    '/vendor/core/plugins/analytics/js/analytics.js'
                ]);
        }
    }

    /**
     * @param array $widgets
     * @param Collection $widgetSettings
     * @return array
     * @throws \Throwable
     *
     */
    public function addGeneralWidget($widgets, $widgetSettings)
    {
        $widget = new DashboardWidgetInstance;

        $widget->permission = 'analytics.general';
        $widget->key = 'widget_analytics_general';
        $widget->title = trans('plugins/analytics::analytics.widget_analytics_general');
        $widget->icon = 'fas fa-chart-line';
        $widget->color = '#f2784b';
        $widget->route = route('analytics.general');
        $widget->bodyClass = 'row';
        $widget->hasLoadCallback = true;
        $widget->isEqualHeight = false;

        return $widget->init($widgets, $widgetSettings);
    }

    /**
     * @param array $widgets
     * @param Collection $widgetSettings
     * @return array
     * @throws \Throwable
     *
     */
    public function addPageWidget($widgets, $widgetSettings)
    {
        $widget = new DashboardWidgetInstance;

        $widget->permission = 'analytics.page';
        $widget->key = 'widget_analytics_page';
        $widget->title = trans('plugins/analytics::analytics.widget_analytics_page');
        $widget->icon = 'far fa-newspaper';
        $widget->color = '#3598dc';
        $widget->route = route('analytics.page');
        $widget->bodyClass = 'scroll-table';
        $widget->column = 'col-md-6 col-sm-6';

        return $widget->init($widgets, $widgetSettings);
    }

    /**
     * @param array $widgets
     * @param Collection $widgetSettings
     * @return array
     * @throws \Throwable
     *
     */
    public function addBrowserWidget($widgets, $widgetSettings)
    {
        $widget = new DashboardWidgetInstance;

        $widget->permission = 'analytics.browser';
        $widget->key = 'widget_analytics_browser';
        $widget->title = trans('plugins/analytics::analytics.widget_analytics_browser');
        $widget->icon = 'fab fa-safari';
        $widget->color = '#8e44ad';
        $widget->route = route('analytics.browser');
        $widget->bodyClass = 'scroll-table';
        $widget->column = 'col-md-6 col-sm-6';

        return $widget->init($widgets, $widgetSettings);
    }

    /**
     * @param array $widgets
     * @param Collection $widgetSettings
     * @return array
     * @throws \Throwable
     *
     */
    public function addReferrerWidget($widgets, $widgetSettings)
    {
        $widget = new DashboardWidgetInstance;

        $widget->permission = 'analytics.referrer';
        $widget->key = 'widget_analytics_referrer';
        $widget->title = trans('plugins/analytics::analytics.widget_analytics_referrer');
        $widget->icon = 'fas fa-user-friends';
        $widget->color = '#3598dc';
        $widget->route = route('analytics.referrer');
        $widget->bodyClass = 'scroll-table';
        $widget->column = 'col-md-6 col-sm-6';

        return $widget->init($widgets, $widgetSettings);
    }

    /**
     * @param null $data
     * @return string
     * @throws \Throwable
     *
     */
    public function addAnalyticsSetting($data = null)
    {
        return $data . view('plugins/analytics::setting')->render();
    }
}
