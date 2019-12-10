<?php

namespace Botble\Base\Providers;

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
     * Boot the service provider.
     * @throws \Throwable
     *
     */
    public function boot()
    {
        add_filter(DASHBOARD_FILTER_ADMIN_LIST, [$this, 'addStatsWidgets'], 15, 2);
    }

    /**
     * @param array $widgets
     * @param Collection $widgetSettings
     * @return array
     * @throws \Throwable
     *
     */
    public function addStatsWidgets($widgets, $widgetSettings)
    {
        $plugins = count(scan_folder(plugin_path()));

        $widget = new DashboardWidgetInstance;

        $widget->type = 'stats';
        $widget->permission = 'plugins.list';
        $widget->key = 'widget_total_plugins';
        $widget->title = trans('core/base::system.plugins');
        $widget->icon = 'fa fa-plug';
        $widget->color = '#8e44ad';
        $widget->statsTotal = $plugins;
        $widget->route = route('plugins.list');

        return $widget->init($widgets, $widgetSettings);
    }
}
