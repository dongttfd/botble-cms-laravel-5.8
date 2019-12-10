<?php

namespace Botble\Media\Repositories\Caches;

use Botble\Media\Repositories\Interfaces\MediaFolderInterface;
use Botble\Support\Repositories\Caches\CacheAbstractDecorator;

class MediaFolderCacheDecorator extends CacheAbstractDecorator implements MediaFolderInterface
{

    /**
     * {@inheritdoc}
     */
    public function getFolderByParentId($folder_id, array $params = [], $withTrash = false)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function createSlug($name, $parent_id)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function createName($name, $parent_id)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getBreadcrumbs($parent_id, $breadcrumbs = [])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getTrashed($parent_id, array $params = [])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function deleteFolder($folder_id, $force = false)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getAllChildFolders($parent_id, $child = [])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getFullPath($folder_id, $path = '')
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function restoreFolder($folder_id)
    {
        $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function emptyTrash()
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
}
