<?php

namespace Botble\Dashboard\Http\Controllers;

use Assets;
use Botble\ACL\Repositories\Interfaces\UserInterface;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Dashboard\Repositories\Interfaces\DashboardWidgetInterface;
use Botble\Dashboard\Repositories\Interfaces\DashboardWidgetSettingInterface;
use Exception;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class DashboardController extends BaseController
{

    /**
     * @var DashboardWidgetSettingInterface
     */
    protected $widgetSettingRepository;

    /**
     * @var DashboardWidgetInterface
     */
    protected $widgetRepository;

    /**
     * @var UserInterface
     */
    protected $userRepository;

    /**
     * DashboardController constructor.
     * @param DashboardWidgetSettingInterface $widgetSettingRepository
     * @param DashboardWidgetInterface $widgetRepository
     * @param UserInterface $userRepository
     */
    public function __construct(
        DashboardWidgetSettingInterface $widgetSettingRepository,
        DashboardWidgetInterface $widgetRepository,
        UserInterface $userRepository
    ) {
        $this->widgetSettingRepository = $widgetSettingRepository;
        $this->widgetRepository = $widgetRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function getDashboard(Request $request)
    {
        page_title()->setTitle(trans('core/dashboard::dashboard.title'));

        Assets::addScripts(['blockui', 'sortable', 'equal-height', 'counterup'])
            ->addScriptsDirectly(['vendor/core/js/dashboard.js']);

        do_action(DASHBOARD_ACTION_REGISTER_SCRIPTS);

        /**
         * @var Collection $widgets
         */
        $widgets = $this->widgetRepository->getModel()
            ->with([
                'settings' => function (HasMany $query) use ($request) {
                    $query->where('user_id', '=', $request->user()->getKey())
                        ->select(['status', 'order', 'settings', 'widget_id'])
                        ->orderBy('order', 'asc');
                },
            ])
            ->select(['id', 'name'])
            ->get();

        $widget_data = apply_filters(DASHBOARD_FILTER_ADMIN_LIST, [], $widgets);
        ksort($widget_data);

        $available_widget_ids = collect($widget_data)->pluck('id')->all();

        $widgets = $widgets->reject(function ($item) use ($available_widget_ids) {
            return !in_array($item->id, $available_widget_ids);
        });

        $user_widgets = collect($widget_data)->pluck('view')->all();

        return view('core/dashboard::list', compact('widgets', 'user_widgets'));
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     */
    public function postEditWidgetSettingItem(Request $request, BaseHttpResponse $response)
    {
        try {
            $widget = $this->widgetRepository->getFirstBy([
                'name' => $request->input('name'),
            ]);

            if (!$widget) {
                return $response
                    ->setError()
                    ->setMessage(trans('core/dashboard::dashboard.widget_not_exists'));
            }
            $widget_setting = $this->widgetSettingRepository->firstOrCreate([
                'widget_id' => $widget->id,
                'user_id'   => $request->user()->getKey(),
            ]);
            $widget_setting->settings = array_merge((array)$widget_setting->settings, [
                $request->input('setting_name') => $request->input('setting_value'),
            ]);
            $this->widgetSettingRepository->createOrUpdate($widget_setting);
        } catch (Exception $ex) {
            return $response
                ->setError()
                ->setMessage($ex->getMessage());
        }

        return $response;
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     */
    public function postUpdateWidgetOrder(Request $request, BaseHttpResponse $response)
    {
        foreach ($request->input('items', []) as $key => $item) {
            $widget = $this->widgetRepository->firstOrCreate([
                'name' => $item,
            ]);
            $widget_setting = $this->widgetSettingRepository->firstOrCreate([
                'widget_id' => $widget->id,
                'user_id'   => $request->user()->getKey(),
            ]);
            $widget_setting->order = $key;
            $this->widgetSettingRepository->createOrUpdate($widget_setting);
        }

        return $response->setMessage(trans('core/dashboard::dashboard.update_position_success'));
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     */
    public function getHideWidget(Request $request, BaseHttpResponse $response)
    {
        $widget = $this->widgetRepository->getFirstBy([
            'name' => $request->input('name'),
        ], ['id']);
        if (!empty($widget)) {
            $widget_setting = $this->widgetSettingRepository->firstOrCreate([
                'widget_id' => $widget->id,
                'user_id'   => $request->user()->getKey(),
            ]);
            $widget_setting->status = 0;
            $widget_setting->order = 99 + $widget_setting->id;
            $this->widgetRepository->createOrUpdate($widget_setting);
        }

        return $response->setMessage(trans('core/dashboard::dashboard.hide_success'));
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     */
    public function postHideWidgets(Request $request, BaseHttpResponse $response)
    {
        $widgets = $this->widgetRepository->all();
        foreach ($widgets as $widget) {
            $widget_setting = $this->widgetSettingRepository->firstOrCreate([
                'widget_id' => $widget->id,
                'user_id'   => $request->user()->getKey(),
            ]);
            if (array_key_exists($widget->name, $request->input('widgets', []))) {
                $widget_setting->status = 1;
                $this->widgetRepository->createOrUpdate($widget_setting);
            } else {
                $widget_setting->status = 0;
                $widget_setting->order = 99 + $widget_setting->id;
                $this->widgetRepository->createOrUpdate($widget_setting);
            }
        }

        return $response
            ->setNextUrl(route('dashboard.index'))
            ->setMessage(trans('core/dashboard::dashboard.hide_success'));
    }
}
