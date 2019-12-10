<?php

namespace Botble\Media\Repositories\Caches;

use Botble\Media\Repositories\Interfaces\MediaFileInterface;
use Botble\Support\Repositories\Caches\CacheAbstractDecorator;

class MediaFileCacheDecorator extends CacheAbstractDecorator implements MediaFileInterface
{
    /**
     * {@inheritdoc}
     */
    public function getSpaceUsed()
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getSpaceLeft()
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getQuota()
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getPercentageUsed()
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function createName($name, $folder)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function createSlug($name, $extension, $folder)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getFilesByFolderId($folderId, array $params = [], $withFolders = true, $folderParams = [])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function emptyTrash()
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getTrashed($folderId, array $params = [], $withFolders = true, $folderParams = [])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
