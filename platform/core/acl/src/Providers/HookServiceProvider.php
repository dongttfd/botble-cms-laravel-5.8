<?php

namespace Botble\ACL\Providers;

use Botble\ACL\Repositories\Interfaces\UserInterface;
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
     *
     */
    public function boot()
    {
        add_filter(DASHBOARD_FILTER_ADMIN_LIST, [$this, 'addUserStatsWidget'], 12, 2);
    }

    /**
     * @param array $widgets
     * @param Collection $widgetSettings
     * @return array
     * @throws \Throwable
     *
     */
    public function addUserStatsWidget($widgets, $widgetSettings)
    {
        $users = $this->app->make(UserInterface::class)->count();

        $widget = new DashboardWidgetInstance;

        $widget->type = 'stats';
        $widget->permission = 'users.list';
        $widget->key = 'widget_total_users';
        $widget->title = trans('core/acl::users.users');
        $widget->icon = 'fas fa-users';
        $widget->color = '#3598dc';
        $widget->statsTotal = $users;
        $widget->route = route('users.list');

        return $widget->init($widgets, $widgetSettings);
    }
}
