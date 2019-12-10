<?php

namespace Botble\Member\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface MemberActivityLogInterface extends RepositoryInterface
{
    /**
     * @param $member_id
     * @param int $paginate
     * @return Collection
     */
    public function getAllLogs($member_id, $paginate = 10);
}
