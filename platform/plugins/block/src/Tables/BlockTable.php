<?php

namespace Botble\Block\Tables;

use Auth;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Block\Repositories\Interfaces\BlockInterface;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class BlockTable extends TableAbstract
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
     * BlockTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param BlockInterface $blockRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, BlockInterface $blockRepository)
    {
        $this->repository = $blockRepository;
        $this->setOption('id', 'table-static-blocks');
        parent::__construct($table, $urlGenerator);

        if (!Auth::user()->hasAnyPermission(['block.edit', 'block.delete'])) {
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
                if (!Auth::user()->hasPermission('block.edit')) {
                    return $item->name;
                }

                return anchor_link(route('block.edit', $item->id), $item->name);
            })
            ->editColumn('alias', function ($item) {
                return generate_shortcode('static-block', ['alias' => $item->alias]);
            })
            ->editColumn('checkbox', function ($item) {
                return table_checkbox($item->id);
            })
            ->editColumn('created_at', function ($item) {
                return date_from_database($item->created_at, config('core.base.general.date_format.date'));
            })
            ->editColumn('status', function ($item) {
                return $item->status->toHtml();
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, BLOCK_MODULE_SCREEN_NAME)
            ->addColumn('operations', function ($item) {
                return table_actions('block.edit', 'block.delete', $item);
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
            ->select([
                'blocks.id',
                'blocks.alias',
                'blocks.name',
                'blocks.created_at',
                'blocks.status',
            ]);

        return $this->applyScopes(apply_filters(BASE_FILTER_TABLE_QUERY, $query, $model, BLOCK_MODULE_SCREEN_NAME));
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
                'name'  => 'blocks.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'name'       => [
                'name'  => 'blocks.name',
                'title' => trans('core/base::tables.name'),
                'class' => 'text-left',
            ],
            'alias'      => [
                'name'  => 'blocks.alias',
                'title' => trans('core/base::tables.shortcode'),
            ],
            'created_at' => [
                'name'  => 'blocks.created_at',
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
            ],
            'status'     => [
                'name'  => 'blocks.status',
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
        $buttons = $this->addCreateButton(route('block.create'), 'block.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, BLOCK_MODULE_SCREEN_NAME);
    }

    /**
     * @return array
     * @throws \Throwable
     */
    public function bulkActions(): array
    {
        $actions = $this->addDeleteAction(route('block.delete.many'), 'block.delete', parent::bulkActions());

        return $actions;
    }

    /**
     * @return array
     */
    public function getBulkChanges(): array
    {
        return [
            'blocks.name'       => [
                'title'    => trans('core/base::tables.name'),
                'type'     => 'text',
                'validate' => 'required|max:120',
                'callback' => 'getBlocks',
            ],
            'blocks.status'     => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => BaseStatusEnum::labels(),
                'validate' => 'required|' . Rule::in(BaseStatusEnum::values()),
            ],
            'blocks.created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type'  => 'date',
            ],
        ];
    }

    /**
     * @return array
     */
    public function getBlocks()
    {
        return $this->repository->pluck('blocks.name', 'blocks.id');
    }
}
