<?php

namespace Botble\Blog\Tables;

use Auth;
use Botble\Blog\Repositories\Interfaces\TagInterface;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;

class TagTable extends TableAbstract
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
     * TagTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param TagInterface $tagRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, TagInterface $tagRepository)
    {
        $this->repository = $tagRepository;
        $this->setOption('id', 'table-tags');
        parent::__construct($table, $urlGenerator);

        if (!Auth::user()->hasAnyPermission(['tags.edit', 'tags.delete'])) {
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
                if (!Auth::user()->hasPermission('tags.edit')) {
                    return $item->name;
                }

                return anchor_link(route('tags.edit', $item->id), $item->name);
            })
            ->editColumn('checkbox', function ($item) {
                return table_checkbox($item->id);
            })
            ->editColumn('created_at', function ($item) {
                return date_from_database($item->created_at, config('core.base.general.date_format.date'));
            })
            ->editColumn('status', function ($item) {
                if ($this->request()->input('action') === 'excel') {
                    return $item->status->getValue();
                }
                return $item->status->toHtml();
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, TAG_MODULE_SCREEN_NAME)
            ->addColumn('operations', function ($item) {
                return table_actions('tags.edit', 'tags.delete', $item);
            })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Get the query object to be processed by table.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     *
     * @since 2.1
     */
    public function query()
    {
        $model = $this->repository->getModel();
        $query = $model
            ->select([
                'tags.id',
                'tags.name',
                'tags.created_at',
                'tags.status',
            ]);

        return $this->applyScopes(apply_filters(BASE_FILTER_TABLE_QUERY, $query, $model, TAG_MODULE_SCREEN_NAME));
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
                'name'  => 'tags.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'name'       => [
                'name'  => 'tags.name',
                'title' => trans('core/base::tables.name'),
                'class' => 'text-left',
            ],
            'status'     => [
                'name'  => 'tags.status',
                'title' => trans('core/base::tables.status'),
                'width' => '100px',
            ],
            'created_at' => [
                'name'  => 'tags.created_at',
                'title' => trans('core/base::tables.created_at'),
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
        $buttons = $this->addCreateButton(route('tags.create'), 'tags.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, TAG_MODULE_SCREEN_NAME);
    }

    /**
     * @return array
     * @throws \Throwable
     */
    public function bulkActions(): array
    {
        $actions = $this->addDeleteAction(route('tags.delete.many'), 'tags.delete', parent::bulkActions());

        return $actions;
    }

    /**
     * @return array
     */
    public function getBulkChanges(): array
    {
        return [
            'tags.name'       => [
                'title'    => trans('core/base::tables.name'),
                'type'     => 'text',
                'validate' => 'required|max:120',
                'callback' => 'getTags',
            ],
            'tags.status'     => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => [
                    0 => trans('core/base::tables.deactivate'),
                    1 => trans('core/base::tables.activate'),
                ],
                'validate' => 'required|in:0,1',
            ],
            'tags.created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type'  => 'date',
            ],
        ];
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->repository->pluck('tags.name', 'tags.id');
    }
}
