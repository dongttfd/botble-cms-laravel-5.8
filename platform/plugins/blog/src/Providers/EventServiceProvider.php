<?php

namespace Botble\Blog\Providers;

use Botble\Base\Events\RenderingJsonFeedEvent;
use Botble\Base\Events\RenderingSiteMapEvent;
use Botble\Blog\Listeners\RenderingSiteMapListener;
use Botble\Blog\Listeners\RenderingJsonFeedListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     * 
     */
    protected $listen = [
        RenderingSiteMapEvent::class  => [
            RenderingSiteMapListener::class,
        ],
        RenderingJsonFeedEvent::class => [
            RenderingJsonFeedListener::class,
        ],
    ];
}
