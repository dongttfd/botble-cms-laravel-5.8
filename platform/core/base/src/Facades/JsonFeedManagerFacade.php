<?php

namespace Botble\Base\Facades;

use Botble\Base\Supports\JsonFeedManager;
use Illuminate\Support\Facades\Facade;

class JsonFeedManagerFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return JsonFeedManager::class;
    }
}
