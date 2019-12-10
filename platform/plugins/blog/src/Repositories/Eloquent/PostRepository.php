<?php

namespace Botble\Blog\Repositories\Eloquent;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Botble\Blog\Repositories\Interfaces\PostInterface;
use Eloquent;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;

class PostRepository extends RepositoriesAbstract implements PostInterface
{

    /**
     * {@inheritdoc}
     */
    protected $screen = POST_MODULE_SCREEN_NAME;

    /**
     * {@inheritdoc}
     */
    public function getFeatured($limit = 5)
    {
        $data = $this->model
            ->where([
                'posts.status'      => BaseStatusEnum::PUBLISHED,
                'posts.is_featured' => 1,
            ])
            ->limit($limit)
            ->orderBy('posts.created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data, $this->screen)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getListPostNonInList(array $selected = [], $limit = 7)
    {
        $data = $this->model
            ->where('posts.status', '=', BaseStatusEnum::PUBLISHED)
            ->whereNotIn('posts.id', $selected)
            ->limit($limit)
            ->orderBy('posts.created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data, $this->screen)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getRelated($id, $limit = 3)
    {
        $data = $this->model
            ->where('posts.status', '=', BaseStatusEnum::PUBLISHED)
            ->where('posts.id', '!=', $id)
            ->limit($limit)
            ->orderBy('posts.created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data, $this->screen)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getByCategory($category_id, $paginate = 12, $limit = 0)
    {
        if (!is_array($category_id)) {
            $category_id = [$category_id];
        }

        $data = $this->model
            ->where('posts.status', '=', BaseStatusEnum::PUBLISHED)
            ->join('post_categories', 'post_categories.post_id', '=', 'posts.id')
            ->join('categories', 'post_categories.category_id', '=', 'categories.id')
            ->whereIn('post_categories.category_id', $category_id)
            ->select('posts.*')
            ->distinct()
            ->orderBy('posts.created_at', 'desc');

        if ($paginate != 0) {
            return $this->applyBeforeExecuteQuery($data, $this->screen)->paginate($paginate);
        }

        return $this->applyBeforeExecuteQuery($data, $this->screen)->limit($limit)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getByUserId($author_id, $paginate = 6)
    {
        $data = $this->model
            ->where([
                'posts.status'    => BaseStatusEnum::PUBLISHED,
                'posts.author_id' => $author_id,
            ])
            ->select('posts.*')
            ->orderBy('posts.views', 'desc');

        return $this->applyBeforeExecuteQuery($data, $this->screen)->paginate($paginate);
    }

    /**
     * {@inheritdoc}
     */
    public function getDataSiteMap()
    {
        $data = $this->model
            ->where('posts.status', '=', BaseStatusEnum::PUBLISHED)
            ->select('posts.*')
            ->orderBy('posts.created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data, $this->screen)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getByTag($tag, $paginate = 12)
    {
        $data = $this->model
            ->where('posts.status', '=', BaseStatusEnum::PUBLISHED)
            ->whereHas('tags', function ($query) use ($tag) {
                /**
                 * @var Builder $query
                 */
                $query->where('tags.id', $tag);
            })
            ->select('posts.*')
            ->orderBy('posts.created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data, $this->screen)->paginate($paginate);
    }

    /**
     * {@inheritdoc}
     */
    public function getRecentPosts($limit = 5, $category_id = 0)
    {
        $posts = $this->model->where(['posts.status' => BaseStatusEnum::PUBLISHED]);

        if ($category_id != 0) {
            $posts = $posts->join('post_categories', 'post_categories.post_id', '=', 'posts.id')
                ->where('post_categories.category_id', '=', $category_id);
        }

        $data = $posts->limit($limit)
            ->select('posts.*')
            ->orderBy('posts.created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data, $this->screen)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getSearch($query, $limit = 10, $paginate = 10)
    {
        $posts = $this->model->where('status', BaseStatusEnum::PUBLISHED);
        foreach (explode(' ', $query) as $term) {
            $posts = $posts->where('name', 'LIKE', '%' . $term . '%');
        }

        $data = $posts->select('posts.*')
            ->orderBy('posts.created_at', 'desc');

        if ($limit) {
            $data = $data->limit($limit);
        }

        if ($paginate) {
            return $this->applyBeforeExecuteQuery($data, $this->screen)->paginate($paginate);
        }

        return $this->applyBeforeExecuteQuery($data, $this->screen)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getAllPosts($perPage = 12, $active = true)
    {
        $data = $this->model->select('posts.*')
            ->orderBy('posts.created_at', 'desc');

        if ($active) {
            $data = $data->where(['posts.status' => BaseStatusEnum::PUBLISHED]);
        }

        return $this->applyBeforeExecuteQuery($data, $this->screen)->paginate($perPage);
    }

    /**
     * {@inheritdoc}
     */
    public function getPopularPosts($limit, array $args = [])
    {
        $data = $this->model
            ->orderBy('posts.views', 'DESC')
            ->select('posts.*')
            ->limit($limit);

        if (!empty(Arr::get($args, 'where'))) {
            $data = $data->where($args['where']);
        }

        return $this->applyBeforeExecuteQuery($data, $this->screen)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getRelatedCategoryIds($model)
    {
        $model = $model instanceof Eloquent ? $model : $this->findById($model);

        try {
            return $model->categories()->allRelatedIds()->toArray();
        } catch (Exception $exception) {
            return [];
        }
    }
}
