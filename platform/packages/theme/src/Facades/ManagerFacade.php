<?php

namespace Botble\Theme\Facades;

use Botble\Theme\Manager;
use Illuminate\Support\Facades\Facade;

/**
 * Class ManagerFacade
 * @package Botble\Base
 */
class ManagerFacade extends Facade
{

    /**
     * @return string
     * 
     * @since 2.1
     */
    protected static function getFacadeAccessor()
    {
        return Manager::class;
    }
}
