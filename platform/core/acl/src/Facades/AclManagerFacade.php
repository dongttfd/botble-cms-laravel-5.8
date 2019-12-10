<?php

namespace Botble\ACL\Facades;

use Botble\ACL\AclManager;
use Illuminate\Support\Facades\Facade;

class AclManagerFacade extends Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return AclManager::class;
    }
}
