<?php

namespace Botble\Base\Providers;

use Botble\Base\Commands\ClearLogCommand;
use Botble\Base\Commands\PluginActivateCommand;
use Botble\Base\Commands\PluginAssetsPublishCommand;
use Botble\Base\Commands\PluginDeactivateCommand;
use Botble\Base\Commands\PluginRemoveCommand;
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
                PluginAssetsPublishCommand::class,
            ]);
        }

        $this->commands([
            PluginActivateCommand::class,
            PluginDeactivateCommand::class,
            PluginRemoveCommand::class,
            ClearLogCommand::class,
        ]);
    }
}
