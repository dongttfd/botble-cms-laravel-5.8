<?php

namespace Botble\CustomField\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Support\Collection;

interface FieldItemInterface extends RepositoryInterface
{
    /**
     * @param int|array $id
     * @return bool
     */
    public function deleteFieldItem($id);

    /**
     * @param $groupId
     * @param null $parentId
     * @return Collection
     */
    public function getGroupItems($groupId, $parentId = null);

    /**
     * @param int|null $id
     * @param array $data
     * @return int|null
     */
    public function updateWithUniqueSlug($id, array $data);
}
