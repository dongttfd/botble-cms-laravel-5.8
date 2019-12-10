<?php

namespace Botble\Member\Tables;

use Auth;
use Botble\Member\Repositories\Interfaces\MemberInterface;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;

class MemberTable extends TableAbstract
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
     * MemberTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param MemberInterface $memberRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, MemberInterface $memberRepository)
    {
        $this->repository = $memberRepository;
        $this->setOption('id', 'table-members');
        parent::__construct($table, $urlGenerator);

        if (!Auth::user()->hasAnyPermission(['member.edit', 'member.delete'])) {
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
            ->editColumn('first_name', function ($item) {
                if (!Auth::user()->hasPermission('member.edit')) {
                    return $item->getFullName();
                }

                return anchor_link(route('member.edit', $item->id), $item->getFullName());
            })
            ->editColumn('checkbox', function ($item) {
                return table_checkbox($item->id);
            })
            ->editColumn('created_at', function ($item) {
                return date_from_database($item->created_at, config('core.base.general.date_format.date'));
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, MEMBER_MODULE_SCREEN_NAME)
            ->addColumn('operations', function ($item) {
                return table_actions('member.edit', 'member.delete', $item);
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
        $model = app(MemberInterface::class)->getModel();
        $query = $model
            ->select([
                'members.id',
                'members.first_name',
                'members.last_name',
                'members.email',
                'members.created_at',
            ]);
        return $this->applyScopes(apply_filters(BASE_FILTER_TABLE_QUERY, $query, $model, MEMBER_MODULE_SCREEN_NAME));
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
                'name'  => 'members.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'first_name' => [
                'name'  => 'members.first_name',
                'title' => trans('core/base::tables.name'),
                'class' => 'text-left',
            ],
            'email'      => [
                'name'  => 'members.email',
                'title' => trans('core/base::tables.email'),
                'class' => 'text-left',
            ],
            'created_at' => [
                'name'  => 'members.created_at',
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
        $buttons = $this->addCreateButton(route('member.create'), 'member.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, MEMBER_MODULE_SCREEN_NAME);
    }

    /**
     * @return array
     * @throws \Throwable
     */
    public function bulkActions(): array
    {
        $actions = $this->addDeleteAction(route('member.delete.many'), 'member.delete', parent::bulkActions());

        return $actions;
    }

    /**
     * @return mixed
     */
    public function getBulkChanges(): array
    {
        return [
            'members.first_name' => [
                'title'    => __('First name'),
                'type'     => 'text',
                'validate' => 'required|max:120',
                'callback' => 'getFirstNames',
            ],
            'members.last_name' => [
                'title'    => __('Last name'),
                'type'     => 'text',
                'validate' => 'required|max:120',
                'callback' => 'getLastNames',
            ],
            'members.email'      => [
                'title'    => trans('core/base::tables.email'),
                'type'     => 'text',
                'validate' => 'required|max:120|email',
                'callback' => 'getEmails',
            ],
            'members.created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type'  => 'date',
            ],
        ];
    }

    /**
     * @return array
     */
    public function getFirstNames()
    {
        return $this->repository->pluck('members.first_name', 'members.id');
    }

    /**
     * @return array
     */
    public function getLastNames()
    {
        return $this->repository->pluck('members.last_name', 'members.id');
    }

    /**
     * @return array
     */
    public function getEmails()
    {
        return $this->repository->pluck('members.email', 'members.id');
    }
}
