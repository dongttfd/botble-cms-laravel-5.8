<?php

namespace Botble\Dashboard\Supports;

use Auth;
use Botble\Dashboard\Repositories\Interfaces\DashboardWidgetInterface;
use Illuminate\Support\Collection;

class DashboardWidgetInstance
{
    /**
     * @var string
     */
    public $type = 'widget';

    /**
     * @var string
     */
    public $key;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $icon;

    /**
     * @var string
     */
    public $color;

    /**
     * @var string
     */
    public $route;

    /**
     * @var string
     */
    public $bodyClass;

    /**
     * @var bool
     */
    public $isEqualHeight = true;

    /**
     * @var string
     */
    public $column;

    /**
     * @var string
     */
    public $permission;

    /**
     * @var int
     */
    public $statsTotal = 0;

    /**
     * @param $widgets
     * @param Collection $widgetSettings
     * @return array
     * @throws \Throwable
     */
    public function init($widgets, $widgetSettings)
    {
        if (!Auth::user()->hasPermission($this->permission)) {
            return $widgets;
        }

        $widget = $widgetSettings->where('name', $this->key)->first();
        $widgetSetting = $widget ? $widget->settings->first() : null;

        if (!$widget) {
            $widget = app(DashboardWidgetInterface::class)
                ->firstOrCreate(['name' => $this->key]);
        }

        $widget->title = $this->title;
        $widget->icon = $this->icon;
        $widget->color = $this->color;
        $widget->route = $this->route;
        if ($this->type === 'widget') {
            $widget->bodyClass = $this->bodyClass;
            $widget->column = $this->column;

            $data = [
                'id'   => $widget->id,
                'view' => view('core/dashboard::widgets.base', compact('widget', 'widgetSetting'))->render(),
            ];

            if (empty($widgetSetting) || array_key_exists($widgetSetting->order, $widgets)) {
                $widgets[] = $data;
            } else {
                $widgets[$widgetSetting->order] = $data;
            }

            return $widgets;
        }

        $widget->statsTotal = $this->statsTotal;

        $widgets[$this->key] = [
            'id'   => $widget->id,
            'view' => view('core/dashboard::widgets.stats', compact('widget', 'widgetSetting'))->render(),
        ];

        return $widgets;
    }
}