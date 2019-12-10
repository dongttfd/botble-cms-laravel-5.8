<?php

namespace Botble\Base\Facades;

use Botble\Base\Supports\EmailHandler;
use Illuminate\Support\Facades\Facade;

/**
 * Class EmailHandlerFacade
 * @package Botble\Base\Facades
 */
class EmailHandlerFacade extends Facade
{

    /**
     * @return string
     *
     * @since 2.2
     */
    protected static function getFacadeAccessor()
    {
        return EmailHandler::class;
    }
}
