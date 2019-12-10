<?php

namespace Botble\Blog\Tables;

use Auth;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Blog\Exports\PostExport;
use Botble\Blog\Models\Post;
use Botble\Blog\Repositories\Interfaces\CategoryInterface;
use Botble\Blog\Repositories\Interfaces\PostInterface;
use Botble\Table\Abstracts\TableAbstract;
use Carbon\Carbon;
use Html;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;

class PostTable extends TableAbstract
{
    /**
     * @var bool
     */
    protected $hasActions = true;

    /**
     * @var bool
     */
    protected $hasFilter = true;

    /**
     * @var CategoryInterface
     */
    protected $categoryRepository;

    /**
     * @var string
     */
    protected $exportClass = PostExport::class;

    /**
     * PostTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param PostInterface $postRepository
     * @param CategoryInterface $categoryRepostory
     */
    public function __construct(
        DataTables $table,
        UrlGenerator $urlGenerator,
        PostInterface $postRepository,
        CategoryInterface $categoryRepository
    ) {
        $this->repository = $postRepository;
        $this->setOption('id', 'table-posts');
        $this->categoryRepository = $categoryRepository;
        parent::__construct($table, $urlGenerator);

        if (!Auth::user()->hasAnyPermission(['posts.edit', 'posts.delete'])) {
            $this->hasOperations = false;
            $this->hasActions = false;
        }
    }

    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @since 2.1
     */
    public function ajax()
    {
        $data = $this->table
            ->eloquent($this->query())
            ->editColumn('name', function ($item) {
                if (!Auth::user()->hasPermission('posts.edit')) {
                    return $item->name;
                }

                return anchor_link(route('posts.edit', $item->id), $item->name);
            })
            ->editColumn('image', function ($item) {
                if ($this->request()->input('action') === 'excel') {
                    return get_object_image($item->image, 'thumb');
                }
                return Html::image(get_object_image($item->image, 'thumb'), $item->name, ['width' => 50]);
            })
            ->editColumn('checkbox', function ($item) {
                return table_checkbox($item->id);
            })
            ->editColumn('created_at', function ($item) {
                return date_from_database($item->created_at, config('core.base.general.date_format.date'));
            })
            ->editColumn('updated_at', function ($item) {
                return implode(', ', $item->categories->pluck('name')->all());
            })
            ->editColumn('author_id', function ($item) {
                return $item->author ? $item->author->getFullName() : null;
            })
            ->editColumn('status', function ($item) {
                if ($this->request()->input('action') === 'excel') {
                    return $item->status->getValue();
                }
                return $item->status->toHtml();
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, POST_MODULE_SCREEN_NAME)
            ->addColumn('operations', function ($item) {
                return table_actions('posts.edit', 'posts.delete', $item);
            })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Get the query object to be processed by the table.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     *
     * @since 2.1
     */
    public function query()
    {
        $model = $this->repository->getModel();
        $query = $model
            ->with(['categories'])
            ->select([
                'posts.id',
                'posts.name',
                'posts.image',
                'posts.created_at',
                'posts.status',
                'posts.updated_at',
                'posts.author_id',
                'posts.author_type',
            ]);

        return $this->applyScopes(apply_filters(BASE_FILTER_TABLE_QUERY, $query, $model, POST_MODULE_SCREEN_NAME));
    }

    /**
     * @return array
     *
     * @since 2.1
     */
    public function columns()
    {
        return [
            'id'         => [
                'name'  => 'posts.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'image'      => [
                'name'  => 'posts.image',
                'title' => trans('core/base::tables.image'),
                'width' => '70px',
            ],
            'name'       => [
                'name'  => 'posts.name',
                'title' => trans('core/base::tables.name'),
                'class' => 'text-left',
            ],
            'updated_at' => [
                'name'      => 'posts.updated_at',
                'title'     => trans('plugins/blog::posts.categories'),
                'width'     => '150px',
                'class'     => 'no-sort',
                'orderable' => false,
            ],
            'author_id'  => [
                'name'      => 'posts.author_id',
                'title'     => trans('plugins/blog::posts.author'),
                'width'     => '150px',
                'class'     => 'no-sort',
                'orderable' => false,
            ],
            'created_at' => [
                'name'  => 'posts.created_at',
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
            ],
            'status'     => [
                'name'  => 'posts.status',
                'title' => trans('core/base::tables.status'),
                'width' => '100px',
            ],
        ];
    }

    /**
     * @return array
     *
     * @since 2.1
     * @throws \Throwable
     */
    public function buttons()
    {
        $buttons = $this->addCreateButton(route('posts.create'), 'posts.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, POST_MODULE_SCREEN_NAME);
    }

    /**
     * @return array
     * @throws \Throwable
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('posts.delete.many'), 'posts.delete', parent::bulkActions());
    }

    /**
     * @return array
     */
    public function getBulkChanges(): array
    {
        return [
            'posts.name'       => [
                'title'    => trans('core/base::tables.name'),
                'type'     => 'text',
                'validate' => 'required|max:120',
                'callback' => 'getPosts',
            ],
            'posts.status'     => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => BaseStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', BaseStatusEnum::values()),
            ],
            'posts.created_at' => [
                'title'    => trans('core/base::tables.created_at'),
                'type'     => 'date',
                'validate' => 'required',
            ],
            'category'         => [
                'title'    => __('Category'),
                'type'     => 'select-search',
                'validate' => 'required',
                'callback' => 'getCategories',
            ],
        ];
    }

    /**
     * @return array
     */
    public function getPosts()
    {
        return $this->repository->pluck('posts.name', 'posts.id');
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categoryRepository->pluck('categories.name', 'categories.id');
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @param string $key
     * @param string $operator
     * @param string $value
     * @return $this|\Illuminate\Database\Query\Builder|string|static
     */
    public function applyFilterCondition($query, string $key, string $operator, ?string $value)
    {
        switch ($key) {
            case 'posts.created_at':
                $value = Carbon::createFromFormat('Y/m/d', $value)->toDateString();
                $query = $query->whereDate($key, $operator, $value);
                break;
            case 'category':
                $query->join('post_categories', 'post_categories.post_id', '=', 'posts.id')
                    ->join('categories', 'post_categories.category_id', '=', 'categories.id')
                    ->where('post_categories.category_id', $operator, $value);
                break;
            default:
                if ($operator !== '=') {
                    $value = (float)$value;
                }
                $query = $query->where($key, $operator, $value);
        }

        return $query;
    }

    /**
     * @param Post $item
     * @param string $input_key
     * @param string $input_value
     * @return false|\Illuminate\Database\Eloquent\Model
     */
    public function saveBulkChangeItem($item, string $input_key, ?string $input_value)
    {
        if ($input_key === 'category') {
            $item->categories()->sync([$input_value]);
            return $item;
        }

        return parent::saveBulkChangeItem($item, $input_key, $input_value);
    }

    /**
     * @return array
     */
    public function getDefaultButtons(): array
    {
        return ['excel', 'reload'];
    }
}
