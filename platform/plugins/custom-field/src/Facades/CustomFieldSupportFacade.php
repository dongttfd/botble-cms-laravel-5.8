<?php

namespace Botble\CustomField\Facades;

use Illuminate\Support\Facades\Facade;
use Botble\CustomField\Support\CustomFieldSupport;

/**
 * Class CustomFieldSupportFacade
 * @package Botble\CustomField\Facades
 */
class CustomFieldSupportFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return CustomFieldSupport::class;
    }
}
