<?php

use Botble\Widget\Repositories\Interfaces\WidgetInterface;

if (!function_exists('register_widget')) {
    /**
     * @param $widget_id
     */
    function register_widget($widget_id)
    {
        Widget::registerWidget($widget_id);
    }
}

if (!function_exists('register_sidebar')) {
    /**
     * @param $args
     */
    function register_sidebar($args)
    {
        WidgetGroup::setGroup($args);
    }
}

if (!function_exists('remove_sidebar')) {
    /**
     * @param $sidebar_id
     */
    function remove_sidebar($sidebar_id)
    {
        WidgetGroup::removeGroup($sidebar_id);
    }
}

if (!function_exists('dynamic_sidebar')) {
    /**
     * @param $sidebar_id
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    function dynamic_sidebar($sidebar_id)
    {
        $language_code = null;
        if (is_plugin_active('language')) {
            $current_locale = is_in_admin() ? \Language::getCurrentAdminLocaleCode() : \Language::getCurrentLocaleCode();
            $language_code = $current_locale && $current_locale != \Language::getDefaultLocaleCode() ? '-' . $current_locale : null;
        }

        $widgets = app(WidgetInterface::class)->getByTheme(setting('theme') . $language_code);
        foreach ($widgets as $widget) {
            WidgetGroup::group($widget->sidebar_id)
                ->position($widget->position)
                ->addWidget($widget->widget_id, $widget->data);
        }

        return WidgetGroup::group($sidebar_id)->display();
    }
}
