<?php

namespace Botble\Blog\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;

interface TagInterface extends RepositoryInterface
{

    /**
     * @return mixed
     *
     */
    public function getDataSiteMap();

    /**
     * @param int $limit
     * @return mixed
     *
     */
    public function getPopularTags($limit);

    /**
     * @param bool $active
     * @return mixed
     *
     */
    public function getAllTags($active = true);
}
