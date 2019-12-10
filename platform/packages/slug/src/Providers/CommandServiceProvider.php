<?php

namespace Botble\Slug\Providers;

use Botble\Slug\Commands\ChangeSlugPrefixCommand;
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
                ChangeSlugPrefixCommand::class,
            ]);
        }
    }
}
