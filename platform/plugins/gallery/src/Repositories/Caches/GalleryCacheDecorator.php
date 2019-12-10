<?php

namespace Botble\Gallery\Repositories\Caches;

use Botble\Support\Repositories\Caches\CacheAbstractDecorator;
use Botble\Gallery\Repositories\Interfaces\GalleryInterface;

class GalleryCacheDecorator extends CacheAbstractDecorator implements GalleryInterface
{
    /**
     * {@inheritdoc}
     */
    public function getAll()
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getDataSiteMap()
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getFeaturedGalleries($limit)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
