<?php

namespace Botble\Media\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;

interface MediaFileInterface extends RepositoryInterface
{
    /**
     * @return mixed
     *
     */
    public function getSpaceUsed();

    /**
     * @return mixed
     */
    public function getSpaceLeft();

    /**
     * @return mixed
     *
     */
    public function getQuota();

    /**
     * @return mixed
     *
     */
    public function getPercentageUsed();

    /**
     * @param $name
     * @param $folder
     *
     */
    public function createName($name, $folder);

    /**
     * @param $name
     * @param $extension
     * @param $folder
     *
     */
    public function createSlug($name, $extension, $folder);

    /**
     * @param $folderId
     * @param array $params
     * @param bool $withFolders
     * @param array $folderParams
     * @return mixed
     */
    public function getFilesByFolderId($folderId, array $params = [], $withFolders = true, $folderParams = []);

    /**
     * @param $folder_id
     * @param array $params
     * @return mixed
     */
    /**
     * @param $folderId
     * @param array $params
     * @param bool $withFolders
     * @param array $folderParams
     * @return mixed
     */
    public function getTrashed($folderId, array $params = [], $withFolders = true, $folderParams = []);

    /**
     * @return mixed
     *
     */
    public function emptyTrash();
}
