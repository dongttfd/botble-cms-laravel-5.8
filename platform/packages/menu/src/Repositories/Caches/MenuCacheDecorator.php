<?php

namespace Botble\Menu\Repositories\Caches;

use Botble\Menu\Repositories\Interfaces\MenuInterface;
use Botble\Support\Repositories\Caches\CacheAbstractDecorator;

class MenuCacheDecorator extends CacheAbstractDecorator implements MenuInterface
{

    /**
     * {@inheritdoc}
     */
    public function findBySlug($slug, $active, $selects = [])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function createSlug($name)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
}
