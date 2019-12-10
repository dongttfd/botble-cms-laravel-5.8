<?php

namespace Botble\Language\Providers;

use Botble\Language\Commands\SyncOldDataCommand;
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
                SyncOldDataCommand::class,
            ]);
        }
    }
}
