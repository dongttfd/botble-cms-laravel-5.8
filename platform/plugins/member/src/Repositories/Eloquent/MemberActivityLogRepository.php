<?php

namespace Botble\Member\Repositories\Eloquent;

use Botble\Member\Repositories\Interfaces\MemberActivityLogInterface;
use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;

class MemberActivityLogRepository extends RepositoriesAbstract implements MemberActivityLogInterface
{
    /**
     * {@inheritdoc}
     */
    public function getAllLogs($member_id, $paginate = 10)
    {
        return $this->model
            ->where('member_id', $member_id)
            ->latest('created_at')
            ->paginate($paginate);
    }
}
