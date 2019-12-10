<?php

namespace Botble\ACL\Tables;

use AclManager;
use Auth;
use Botble\ACL\Repositories\Interfaces\UserInterface;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Table\Abstracts\TableAbstract;
use Exception;
use Html;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;

class UserTable extends TableAbstract
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
     * UserTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param UserInterface $userRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, UserInterface $userRepository)
    {
        $this->repository = $userRepository;
        $this->setOption('id', 'table-users');
        parent::__construct($table, $urlGenerator);

        if (!Auth::user()->hasAnyPermission(['users.impersonate', 'users.edit', 'users.delete'])) {
            $this->hasOperations = false;
        }

        if (!Auth::user()->hasAnyPermission(['users.edit', 'users.delete'])) {
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
            ->editColumn('checkbox', function ($item) {
                return table_checkbox($item->id);
            })
            ->editColumn('username', function ($item) {
                if (!Auth::user()->hasPermission('users.edit')) {
                    return $item->username;
                }

                return anchor_link(route('user.profile.view', $item->id), $item->username);
            })
            ->editColumn('created_at', function ($item) {
                return date_from_database($item->created_at, config('core.base.general.date_format.date'));
            })
            ->editColumn('role_name', function ($item) {
                if (!Auth::user()->hasPermission('users.edit')) {
                    return $item->role_name;
                }

                return view('core/acl::users.partials.role', ['item' => $item])->render();
            })
            ->editColumn('super_user', function ($item) {
                return $item->super_user ? __('Yes') : __('No');
            })
            ->editColumn('status', function ($item) {
                return table_status(AclManager::getActivationRepository()->completed($item) ? 'publish' : 'pending');
            })
            ->removeColumn('role_id');

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, USER_MODULE_SCREEN_NAME)
            ->addColumn('operations', function ($item) {

                $action = null;
                if (Auth::user()->isSuperUser()) {
                    $action = Html::link(route('users.make-super', $item->id), __('Make super'),
                        ['class' => 'btn btn-info'])->toHtml();

                    if ($item->super_user) {
                        $action = Html::link(route('users.remove-super', $item->id), __('Remove super'),
                            ['class' => 'btn btn-danger'])->toHtml();
                    }
                }

                $impersonate = null;
                if (Auth::user()->hasPermission('users.impersonate')) {
                    $impersonate = Html::link('button', __('Login as this user'),
                        ['class' => 'btn btn-warning', 'disabled' => true])->toHtml();

                    if (Auth::user()->id !== $item->id && AclManager::getActivationRepository()->completed($item)) {
                        $impersonate = Html::link(route('users.impersonate', $item->id), __('Login as this user'),
                            ['class' => 'btn btn-warning'])->toHtml();
                    }
                }

                return $action . $impersonate . view('core/acl::users.partials.actions', ['item' => $item])->render();
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
        $query = $model->leftJoin('role_users', 'users.id', '=', 'role_users.user_id')
            ->leftJoin('roles', 'roles.id', '=', 'role_users.role_id')
            ->select([
                'users.id',
                'users.username',
                'users.email',
                'roles.name as role_name',
                'roles.id as role_id',
                'users.updated_at',
                'users.created_at',
                'users.super_user',
            ]);

        return $this->applyScopes(apply_filters(BASE_FILTER_TABLE_QUERY, $query, $model, USER_MODULE_SCREEN_NAME));
    }

    /**
     * @return array
     *
     * @since 2.1
     */
    public function columns()
    {
        $columns = [
            'id'         => [
                'name'  => 'users.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'username'   => [
                'name'  => 'users.username',
                'title' => trans('core/acl::users.username'),
                'class' => 'text-left',
            ],
            'email'      => [
                'name'  => 'users.email',
                'title' => trans('core/acl::users.email'),
                'class' => 'text-left',
            ],
            'role_name'  => [
                'name'  => 'role_name',
                'title' => trans('core/acl::users.role'),
            ],
            'created_at' => [
                'name'  => 'users.created_at',
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
            ],
            'status'     => [
                'name'  => 'users.updated_at',
                'title' => trans('core/base::tables.status'),
                'width' => '100px',
            ],
            'super_user' => [
                'name'  => 'users.super_user',
                'title' => __('Is super?'),
                'width' => '100px',
            ],
        ];

        return $columns;
    }

    /**
     * @return array
     * @throws \Throwable
     * @since 2.1
     *
     */
    public function buttons()
    {
        $buttons = $this->addCreateButton(route('users.create'), 'users.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, USER_MODULE_SCREEN_NAME);
    }

    /**
     * @return string
     *
     */
    public function htmlDrawCallbackFunction(): ?string
    {
        return parent::htmlDrawCallbackFunction() . '$(".editable").editable();';
    }

    /**
     * @return array
     * @throws \Throwable
     *
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('users.delete.many'), 'users.delete', parent::bulkActions());
    }

    /**
     * @return array
     *
     */
    public function getFilters(): array
    {
        $filters = $this->getBulkChanges();
        Arr::forget($filters, 'users.status');

        return $filters;
    }

    /**
     * @return array
     *
     */
    public function getBulkChanges(): array
    {
        return [
            'users.username'   => [
                'title'    => trans('core/acl::users.username'),
                'type'     => 'text',
                'validate' => 'required|max:120',
                'callback' => 'getUserNames',
            ],
            'users.email'      => [
                'title'    => trans('core/base::tables.email'),
                'type'     => 'text',
                'validate' => 'required|max:120|email',
                'callback' => 'getEmails',
            ],
            'users.status'     => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => [
                    0 => trans('core/base::tables.deactivate'),
                    1 => trans('core/base::tables.activate'),
                ],
                'validate' => 'required|in:0,1',
            ],
            'users.created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type'  => 'date',
            ],
        ];
    }

    /**
     * @return array
     *
     */
    public function getOperationsHeading()
    {
        return [
            'operations' => [
                'title'      => trans('core/base::tables.operations'),
                'width'      => '350px',
                'class'      => 'text-right',
                'orderable'  => false,
                'searchable' => false,
                'exportable' => false,
                'printable'  => false,
            ],
        ];
    }

    /**
     * @return array
     *
     */
    public function getUserNames()
    {
        return $this->repository->pluck('users.username', 'users.id');
    }

    /**
     * @return array
     *
     */
    public function getEmails()
    {
        return $this->repository->pluck('users.email', 'users.id');
    }

    /**
     * @param $ids
     * @param $input_key
     * @param $input_value
     * @return bool
     * @throws Exception
     *
     */
    public function saveBulkChanges(array $ids, string $input_key, ?string $input_value): bool
    {
        if (app()->environment('demo')) {
            throw new Exception(trans('core/base::system.disabled_in_demo_mode'));
        }

        if ($input_key === 'users.status') {
            foreach ($ids as $id) {
                if ($input_value == 0 && Auth::user()->getKey() == $id) {
                    throw new Exception(trans('core/acl::users.lock_user_logged_in'));
                }

                $user = $this->repository->findById($id);

                if ($input_value) {
                    AclManager::activate($user);
                } else {
                    AclManager::getActivationRepository()->remove($user);
                }
                event(new UpdatedContentEvent(USER_MODULE_SCREEN_NAME, request(), $user));
            }

            return true;
        }

        return parent::saveBulkChanges($ids, $input_key, $input_value);
    }
}
