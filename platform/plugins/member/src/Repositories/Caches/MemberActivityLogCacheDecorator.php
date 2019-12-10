<?php

namespace Botble\Member\Repositories\Caches;

use Botble\Member\Repositories\Interfaces\MemberActivityLogInterface;
use Botble\Support\Repositories\Caches\CacheAbstractDecorator;

class MemberActivityLogCacheDecorator extends CacheAbstractDecorator implements MemberActivityLogInterface
{
    /**
     * {@inheritdoc}
     */
    public function getAllLogs($member_id, $paginate = 10)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
