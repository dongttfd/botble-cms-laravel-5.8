<?php

namespace Botble\Gallery\Tables;

use Auth;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Gallery\Repositories\Interfaces\GalleryInterface;
use Botble\Table\Abstracts\TableAbstract;
use Html;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class GalleryTable extends TableAbstract
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
     * GalleryTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param GalleryInterface $galleryRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, GalleryInterface $galleryRepository)
    {
        $this->repository = $galleryRepository;
        $this->setOption('id', 'table-galleries');
        parent::__construct($table, $urlGenerator);

        if (!Auth::user()->hasAnyPermission(['galleries.edit', 'galleries.delete'])) {
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
                if (!Auth::user()->hasPermission('galleries.edit')) {
                    return $item->name;
                }

                return anchor_link(route('galleries.edit', $item->id), $item->name);
            })
            ->editColumn('image', function ($item) {
                return Html::image(get_object_image($item->image, 'thumb'), $item->name, ['width' => 70]);
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

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, GALLERY_MODULE_SCREEN_NAME)
            ->addColumn('operations', function ($item) {
                return table_actions('galleries.edit', 'galleries.delete', $item);
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
                'galleries.id',
                'galleries.name',
                'galleries.order',
                'galleries.created_at',
                'galleries.status',
                'galleries.image',
            ]);

        return $this->applyScopes(apply_filters(BASE_FILTER_TABLE_QUERY, $query, $model, GALLERY_MODULE_SCREEN_NAME));
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
                'name'  => 'galleries.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'image'      => [
                'name'  => 'galleries.image',
                'title' => trans('core/base::tables.image'),
                'width' => '70px',
            ],
            'name'       => [
                'name'  => 'galleries.name',
                'title' => trans('core/base::tables.name'),
                'class' => 'text-left',
            ],
            'order'      => [
                'name'  => 'galleries.order',
                'title' => trans('core/base::tables.order'),
                'width' => '100px',
            ],
            'created_at' => [
                'name'  => 'galleries.created_at',
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
            ],
            'status'     => [
                'name'  => 'galleries.status',
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
        $buttons = $this->addCreateButton(route('galleries.create'), 'galleries.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, GALLERY_MODULE_SCREEN_NAME);
    }

    /**
     * @return array
     * @throws \Throwable
     */
    public function bulkActions(): array
    {
        $actions = $this->addDeleteAction(route('galleries.delete.many'), 'galleries.delete', parent::bulkActions());

        return $actions;
    }

    /**
     * @return mixed
     */
    public function getBulkChanges(): array
    {
        return [
            'galleries.name'       => [
                'title'    => trans('core/base::tables.name'),
                'type'     => 'text',
                'validate' => 'required|max:120',
                'callback' => 'getGalleries',
            ],
            'galleries.status'     => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => BaseStatusEnum::labels(),
                'validate' => 'required|' . Rule::in(BaseStatusEnum::values()),
            ],
            'galleries.created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type'  => 'date',
            ],
        ];
    }

    /**
     * @return array
     */
    public function getGalleries()
    {
        return $this->repository->pluck('galleries.name', 'galleries.id');
    }
}
