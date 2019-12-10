<?php

namespace Botble\RequestLog\Providers;

use Assets;
use Auth;
use Botble\Dashboard\Supports\DashboardWidgetInstance;
use Botble\RequestLog\Events\RequestHandlerEvent;
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
     *
     */
    public function boot()
    {
        add_action(BASE_ACTION_SITE_ERROR, [$this, 'handleSiteError'], 125, 1);
        add_filter(DASHBOARD_FILTER_ADMIN_LIST, [$this, 'registerDashboardWidgets'], 125, 2);
    }

    /**
     * Fire event log
     *
     * @param $code
     *
     */
    public function handleSiteError($code)
    {
        event(new RequestHandlerEvent($code));
    }

    /**
     * @param array $widgets
     * @param Collection $widgetSettings
     * @return array
     * @throws \Throwable
     *
     */
    public function registerDashboardWidgets($widgets, $widgetSettings)
    {
        if (!Auth::user()->hasPermission('request-log.list')) {
            return $widgets;
        }

        Assets::addScriptsDirectly(['vendor/core/plugins/request-log/js/request-log.js']);

        $widget = new DashboardWidgetInstance;

        $widget->permission = 'request-log.list';
        $widget->key = 'widget_request_errors';
        $widget->title = trans('plugins/request-log::request-log.widget_request_errors');
        $widget->icon = 'fas fa-unlink';
        $widget->color = '#e7505a';
        $widget->route = route('request-log.widget.request-errors');
        $widget->bodyClass = 'scroll-table';
        $widget->column = 'col-md-6 col-sm-6';

        return $widget->init($widgets, $widgetSettings);
    }
}
