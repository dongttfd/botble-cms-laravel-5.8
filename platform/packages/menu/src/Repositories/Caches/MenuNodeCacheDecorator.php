<?php

namespace Botble\Menu\Repositories\Caches;

use Botble\Menu\Repositories\Interfaces\MenuNodeInterface;
use Botble\Support\Repositories\Caches\CacheAbstractDecorator;

class MenuNodeCacheDecorator extends CacheAbstractDecorator implements MenuNodeInterface
{
    /**
     * {@inheritdoc}
     */
    public function getByMenuId($menu_id, $parent_id, $select = ['*'])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
