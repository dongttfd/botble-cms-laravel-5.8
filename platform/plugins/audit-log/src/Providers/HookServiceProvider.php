<?php

namespace Botble\AuditLog\Providers;

use Assets;
use AuditLog;
use Auth;
use Botble\Dashboard\Supports\DashboardWidgetInstance;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Botble\AuditLog\Events\AuditHandlerEvent;
use Illuminate\Http\Request;

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
        add_action(AUTH_ACTION_AFTER_LOGOUT_SYSTEM, [$this, 'handleLogout'], 45, 3);

        add_action(USER_ACTION_AFTER_UPDATE_PASSWORD, [$this, 'handleUpdatePassword'], 45, 3);
        add_action(USER_ACTION_AFTER_UPDATE_PASSWORD, [$this, 'handleUpdateProfile'], 45, 3);

        if (defined('BACKUP_ACTION_AFTER_BACKUP')) {
            add_action(BACKUP_ACTION_AFTER_BACKUP, [$this, 'handleBackup'], 45, 1);
            add_action(BACKUP_ACTION_AFTER_RESTORE, [$this, 'handleRestore'], 45, 1);
        }

        add_filter(DASHBOARD_FILTER_ADMIN_LIST, [$this, 'registerDashboardWidgets'], 28, 2);
    }

    /**
     * @param string $screen
     * @param Request $request
     * @param \stdClass $data
     *
     */
    public function handleLogin($screen, Request $request, $data)
    {
        event(new AuditHandlerEvent(
            'to the system',
            'logged in',
            $data->id,
            AuditLog::getReferenceName($screen, $data),
            'info'
        ));
    }

    /**
     * @param string $screen
     * @param Request $request
     * @param \stdClass $data
     *
     */
    public function handleLogout($screen, Request $request, $data)
    {
        event(new AuditHandlerEvent(
            'of the system',
            'logged out',
            $data->id,
            AuditLog::getReferenceName($screen, $data),
            'info'
        ));
    }

    /**
     * @param string $screen
     * @param Request $request
     * @param \stdClass $data
     *
     */
    public function handleUpdateProfile($screen, Request $request, $data)
    {
        event(new AuditHandlerEvent(
            $screen,
            'updated profile',
            $data->id,
            AuditLog::getReferenceName($screen, $data),
            'info'
        ));
    }

    /**
     * @param string $screen
     * @param Request $request
     * @param \stdClass $data
     *
     */
    public function handleUpdatePassword($screen, Request $request, $data)
    {
        event(new AuditHandlerEvent(
            $screen,
            'changed password',
            $data->id,
            AuditLog::getReferenceName($screen, $data),
            'danger'
        ));
    }

    /**
     * @param string $screen
     *
     */
    public function handleBackup($screen)
    {
        event(new AuditHandlerEvent($screen, 'backup', 0, '', 'info'));
    }

    /**
     * @param string $screen
     *
     */
    public function handleRestore($screen)
    {
        event(new AuditHandlerEvent($screen, 'restored', 0, '', 'info'));
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
        if (!Auth::user()->hasPermission('audit-log.list')) {
            return $widgets;
        }

        Assets::addScriptsDirectly(['/vendor/core/plugins/audit-log/js/audit-log.js']);

        $widget = new DashboardWidgetInstance;

        $widget->permission = 'audit-log.list';
        $widget->key = 'widget_audit_logs';
        $widget->title = trans('plugins/audit-log::history.widget_audit_logs');
        $widget->icon = 'fas fa-history';
        $widget->color = '#44b6ae';
        $widget->route = route('audit-log.widget.activities');
        $widget->bodyClass = 'scroll-table';
        $widget->column = 'col-md-6 col-sm-6';

        return $widget->init($widgets, $widgetSettings);
    }
}
