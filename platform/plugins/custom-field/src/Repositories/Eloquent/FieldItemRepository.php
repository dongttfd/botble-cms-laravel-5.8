<?php

namespace Botble\CustomField\Repositories\Eloquent;

use Botble\CustomField\Repositories\Interfaces\FieldItemInterface;
use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Illuminate\Support\Collection;

class FieldItemRepository extends RepositoriesAbstract implements FieldItemInterface
{

    /**
     * @param int|array $id
     * @return bool
     * @throws \Exception
     */
    public function deleteFieldItem($id)
    {
        return $this->model->whereIn('id', (array)$id)->delete();
    }

    /**
     * @param int $groupId
     * @param null $parentId
     * @return Collection
     */
    public function getGroupItems($groupId, $parentId = null)
    {
        return $this->model
            ->where([
                'field_group_id' => $groupId,
                'parent_id'      => $parentId,
            ])
            ->orderBy('order', 'ASC')
            ->get();
    }

    /**
     * @param int|null $id
     * @param array $data
     * @return false|\Illuminate\Database\Eloquent\Model
     */
    public function updateWithUniqueSlug($id, array $data)
    {
        $data['slug'] = $this->makeUniqueSlug($id, $data['field_group_id'], $data['parent_id'], $data['slug'], $data['position']);

        return $this->createOrUpdate($data, compact('id'));
    }

    /**
     * @param int $id
     * @param int $fieldGroupId
     * @param int $parentId
     * @param string $slug
     * @return string
     */
    protected function makeUniqueSlug($id, $fieldGroupId, $parentId, $slug, $position)
    {
        $isExist = $this->getFirstBy([
            'slug'      => $slug,
            //'field_group_id' => $fieldGroupId,
            'parent_id' => $parentId,
        ]);

        if ($isExist && (int)$id != (int)$isExist->id) {
            return $slug . '_' . time() . $position;
        }

        return $slug;
    }
}
