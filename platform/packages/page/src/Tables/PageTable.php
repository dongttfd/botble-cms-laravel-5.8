<?php

namespace Botble\Page\Tables;

use Auth;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Page\Repositories\Interfaces\PageInterface;
use Botble\Table\Abstracts\TableAbstract;
use Html;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class PageTable extends TableAbstract
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
     * PageTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param PageInterface $pageRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, PageInterface $pageRepository)
    {
        $this->repository = $pageRepository;
        $this->setOption('id', 'table-pages');
        parent::__construct($table, $urlGenerator);

        if (!Auth::user()->hasAnyPermission(['pages.edit', 'pages.delete'])) {
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
                    $name = $item->name;
                } else {
                    $name = anchor_link(route('pages.edit', $item->id), $item->name);
                }


                if (setting('show_on_front') == $item->id) {
                    $name .=  Html::tag('span', ' — ' . trans('packages/page::pages.front_page'), [
                        'class' => 'additional-page-name',
                    ])->toHtml();
                }

                return apply_filters(PAGE_FILTER_PAGE_NAME_IN_ADMIN_LIST, $name, $item);
            })
            ->editColumn('checkbox', function ($item) {
                return table_checkbox($item->id);
            })
            ->editColumn('template', function ($item) {
                return Arr::get(get_page_templates(), $item->template);
            })
            ->editColumn('created_at', function ($item) {
                return date_from_database($item->created_at, config('core.base.general.date_format.date'));
            })
            ->editColumn('status', function ($item) {
                return $item->status->toHtml();
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, PAGE_MODULE_SCREEN_NAME)
            ->addColumn('operations', function ($item) {
                return table_actions('pages.edit', 'pages.delete', $item);
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
                'pages.id',
                'pages.name',
                'pages.template',
                'pages.created_at',
                'pages.status',
            ]);

        return $this->applyScopes(apply_filters(BASE_FILTER_TABLE_QUERY, $query, $model, PAGE_MODULE_SCREEN_NAME));
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
                'name'  => 'pages.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'name'       => [
                'name'  => 'pages.name',
                'title' => trans('core/base::tables.name'),
                'class' => 'text-left',
            ],
            'template'   => [
                'name'  => 'pages.template',
                'title' => trans('core/base::tables.template'),
            ],
            'created_at' => [
                'name'  => 'pages.created_at',
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
            ],
            'status'     => [
                'name'  => 'pages.status',
                'title' => trans('core/base::tables.status'),
                'width' => '100px',
            ],
        ];
    }

    /**
     * @return array
     * @throws \Throwable
     * @since 2.1
     *
     */
    public function buttons()
    {
        $buttons = $this->addCreateButton(route('pages.create'), 'pages.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, PAGE_MODULE_SCREEN_NAME);
    }

    /**
     * @return array
     * @throws \Throwable
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('pages.delete.many'), 'pages.delete', parent::bulkActions());
    }

    /**
     * @return array
     */
    public function getBulkChanges(): array
    {
        return [
            'pages.name'       => [
                'title'    => trans('core/base::tables.name'),
                'type'     => 'text',
                'validate' => 'required|max:120',
                'callback' => 'getPages',
            ],
            'pages.status'     => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => BaseStatusEnum::labels(),
                'validate' => 'required|' . Rule::in(BaseStatusEnum::values()),
            ],
            'pages.template'   => [
                'title'    => trans('core/base::tables.template'),
                'type'     => 'select',
                'choices'  => get_page_templates(),
                'validate' => 'required',
            ],
            'pages.created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type'  => 'date',
            ],
        ];
    }

    /**
     * @return array
     */
    public function getPages(): array
    {
        return $this->repository->pluck('pages.name', 'pages.id');
    }
}
