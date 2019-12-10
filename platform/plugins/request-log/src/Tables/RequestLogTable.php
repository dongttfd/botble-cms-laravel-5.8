<?php

namespace Botble\RequestLog\Tables;

use Auth;
use Botble\RequestLog\Repositories\Interfaces\RequestLogInterface;
use Botble\Table\Abstracts\TableAbstract;
use Html;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;

class RequestLogTable extends TableAbstract
{

    /**
     * @var bool
     */
    protected $hasActions = true;

    /**
     * @var bool
     */
    protected $hasFilter = false;


    /**
     * RequestLogTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param RequestLogInterface $requestLogRepository
     */
    public function __construct(
        DataTables $table,
        UrlGenerator $urlGenerator,
        RequestLogInterface $requestLogRepository
    )
    {
        $this->repository = $requestLogRepository;
        $this->setOption('id', 'table-request-histories');
        parent::__construct($table, $urlGenerator);

        if (!Auth::user()->hasPermission('request-log.delete')) {
            $this->hasOperations = false;
            $this->hasActions = false;
        }
    }

    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $data = $this->table
            ->eloquent($this->query())
            ->editColumn('checkbox', function ($item) {
                return table_checkbox($item->id);
            })
            ->editColumn('url', function ($item) {
                return Html::link($item->url, $item->url, ['target' => '_blank'])->toHtml();
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, REQUEST_LOG_MODULE_SCREEN_NAME)
            ->addColumn('operations', function ($item) {
                return table_actions(null, 'request-log.delete', $item);
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
                'request_logs.id',
                'request_logs.url',
                'request_logs.status_code',
                'request_logs.count',
            ]);
        return $this->applyScopes(apply_filters(BASE_FILTER_TABLE_QUERY, $query, $model, REQUEST_LOG_MODULE_SCREEN_NAME));
    }

    /**
     * @return array
     */
    public function columns()
    {
        return [
            'id'          => [
                'name'  => 'request_logs.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'url'         => [
                'name'  => 'request_logs.url',
                'title' => __('URL'),
                'class' => 'text-left',
            ],
            'status_code' => [
                'name'  => 'request_logs.status_code',
                'title' => __('Status Code'),
            ],
            'count'       => [
                'name'  => 'request_logs.count',
                'title' => __('Count'),
            ],
        ];
    }

    /**
     * @return array
     * 
     * @throws \Throwable
     */
    public function buttons()
    {
        return apply_filters(BASE_FILTER_TABLE_BUTTONS, [], REQUEST_LOG_MODULE_SCREEN_NAME);
    }

    /**
     * @return array
     * @throws \Throwable
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('request-log.delete.many'), 'request-log.delete', parent::bulkActions());
    }
}
