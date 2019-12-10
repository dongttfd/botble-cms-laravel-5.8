<?php

namespace Botble\Base\Facades;

use Botble\Base\Supports\AdminBar;
use Illuminate\Support\Facades\Facade;

class AdminBarFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return AdminBar::class;
    }
}
