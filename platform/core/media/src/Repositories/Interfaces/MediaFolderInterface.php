<?php

namespace Botble\Media\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;

interface MediaFolderInterface extends RepositoryInterface
{

    /**
     * @param $folder_id
     * @param array $params
     * @param bool $withTrash
     * @return mixed
     */
    public function getFolderByParentId($folder_id, array $params = [], $withTrash = false);

    /**
     * @param $name
     * @param $parent_id
     * @return
     *
     */
    public function createSlug($name, $parent_id);

    /**
     * @param $name
     * @param $parent_id
     *
     */
    public function createName($name, $parent_id);

    /**
     * @param $parent_id
     * @param array $breadcrumbs
     * @return array
     */
    public function getBreadcrumbs($parent_id, $breadcrumbs = []);

    /**
     * @param $parent_id
     * @param array $params
     * @return mixed
     */
    public function getTrashed($parent_id, array $params = []);

    /**
     * @param $folder_id
     * @param bool $force
     */
    public function deleteFolder($folder_id, $force = false);

    /**
     * @param $parent_id
     * @param array $child
     * @return array
     */
    public function getAllChildFolders($parent_id, $child = []);

    /**
     * @param $folder_id
     * @param string $path
     * @return string
     *
     */
    public function getFullPath($folder_id, $path = '');

    /**
     * @param $folder_id
     *
     */
    public function restoreFolder($folder_id);

    /**
     * @return mixed
     *
     */
    public function emptyTrash();
}
