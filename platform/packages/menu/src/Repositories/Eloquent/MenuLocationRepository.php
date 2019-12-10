<?php

namespace Botble\Menu\Repositories\Eloquent;

use Botble\Menu\Repositories\Interfaces\MenuLocationInterface;
use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;

class MenuLocationRepository extends RepositoriesAbstract implements MenuLocationInterface
{
    /**
     * @var string 
     */
    protected $screen = MENU_LOCATION_MODULE_SCREEN_NAME;

}
