<?php

namespace Botble\AuditLog;

use Botble\Base\Interfaces\PluginInterface;
use Botble\Dashboard\Repositories\Interfaces\DashboardWidgetInterface;
use Schema;

class Plugin implements PluginInterface
{

    /**
     *
     */
    public static function activate()
    {
    }

    /**
     *
     */
    public static function deactivate()
    {
    }

    /**
     *
     */
    public static function remove()
    {
        Schema::dropIfExists('audit_history');
        app(DashboardWidgetInterface::class)->deleteBy(['name' => 'widget_audit_logs']);
    }
}
