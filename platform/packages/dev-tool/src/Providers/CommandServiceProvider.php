<?php

namespace Botble\DevTool\Providers;

use Botble\DevTool\Commands\Git\InstallHooks;
use Botble\DevTool\Commands\Git\PreCommitHook;
use Botble\DevTool\Commands\InstallCommand;
use Botble\DevTool\Commands\Make\ControllerMakeCommand;
use Botble\DevTool\Commands\Make\FormMakeCommand;
use Botble\DevTool\Commands\Make\ModelMakeCommand;
use Botble\DevTool\Commands\Make\RepositoryMakeCommand;
use Botble\DevTool\Commands\Make\RequestMakeCommand;
use Botble\DevTool\Commands\Make\RouteMakeCommand;
use Botble\DevTool\Commands\Make\TableMakeCommand;
use Botble\DevTool\Commands\PackageCreateCommand;
use Botble\DevTool\Commands\PluginCreateCommand;
use Botble\DevTool\Commands\PluginListCommand;
use Botble\DevTool\Commands\RebuildPermissionsCommand;
use Botble\DevTool\Commands\TestSendMailCommand;
use Botble\DevTool\Commands\ThemeCreateCommand;
use Botble\DevTool\Commands\TruncateTablesCommand;
use Botble\DevTool\Commands\UserCreateCommand;
use Botble\DevTool\Commands\WidgetCreateCommand;
use Botble\DevTool\Commands\WidgetRemoveCommand;
use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
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
        if ($this->app->runningInConsole()) {
            $this->commands([
                TableMakeCommand::class,
                ControllerMakeCommand::class,
                RouteMakeCommand::class,
                RequestMakeCommand::class,
                FormMakeCommand::class,
                ModelMakeCommand::class,
                RepositoryMakeCommand::class,
                PackageCreateCommand::class,
                ThemeCreateCommand::class,
                InstallCommand::class,
                InstallHooks::class,
                PreCommitHook::class,
                TestSendMailCommand::class,
                PluginListCommand::class,
                TruncateTablesCommand::class,
                UserCreateCommand::class,
                RebuildPermissionsCommand::class,
                WidgetCreateCommand::class,
                WidgetRemoveCommand::class,
            ]);
        }

        $this->commands([
            PluginCreateCommand::class,
        ]);
    }
}
