<?php

use Botble\Base\Facades\AdminBarFacade;
use Botble\Base\Facades\DashboardMenuFacade;
use Botble\Base\Facades\PageTitleFacade;
use Botble\Base\Supports\Editor;
use Botble\Base\Supports\PageTitle;

if (!function_exists('table_actions')) {
    /**
     * @param $edit
     * @param $delete
     * @param $item
     * @param string $extra
     * @return string
     * @throws Throwable
     *
     */
    function table_actions($edit, $delete, $item, $extra = null)
    {
        return view('core/base::elements.tables.actions', compact('edit', 'delete', 'item', 'extra'))->render();
    }
}


if (!function_exists('simple_table_actions')) {
    /**
     * @param array $actions
     * @return string
     * @throws Throwable
     *
     */
    function simple_table_actions(array $actions)
    {
        return view('core/base::elements.tables.simple-actions', compact('actions'))->render();
    }
}

if (!function_exists('restore_action')) {
    /**
     * @param $restore
     * @param $item
     * @return string
     *
     * @throws Throwable
     */
    function restore_action($restore, $item)
    {
        return view('core/base::elements.tables.restore', compact('restore', 'item'))->render();
    }
}

if (!function_exists('anchor_link')) {
    /**
     * @param $link
     * @param $name
     * @param array $options
     * @return string
     *
     * @throws Throwable
     */
    function anchor_link($link, $name, array $options = [])
    {
        $options = Html::attributes($options);
        return view('core/base::elements.tables.link', compact('link', 'name', 'options'))->render();
    }
}

if (!function_exists('table_checkbox')) {
    /**
     * @param $id
     * @return string
     *
     * @throws Throwable
     */
    function table_checkbox($id)
    {
        return view('core/base::elements.tables.checkbox', compact('id'))->render();
    }
}

if (!function_exists('table_status')) {
    /**
     * @param $selected
     * @param array $statuses
     * @return string
     * @internal param $status
     * @internal param null $activated_text
     * @internal param null $deactivated_text
     *
     * @throws Throwable
     */
    function table_status($selected, $statuses = [])
    {
        if (empty($statuses) || !is_array($statuses)) {
            $statuses = [
                'pending' => [
                    'class' => 'label-danger',
                    'text'  => trans('core/base::tables.deactivated'),
                ],
                'publish' => [
                    'class' => 'label-success',
                    'text'  => trans('core/base::tables.activated'),
                ],
            ];
        }
        return view('core/base::elements.tables.status', compact('selected', 'statuses'))->render();
    }
}

if (!function_exists('table_featured')) {
    /**
     * @param $is_featured
     * @param null $featured_text
     * @param null $not_featured_text
     * @return string
     * @throws Throwable
     */
    function table_featured($is_featured, $featured_text = null, $not_featured_text = null)
    {
        return view('core/base::elements.tables.is_featured',
            compact('is_featured', 'featured_text', 'not_featured_text'))->render();
    }
}

/**
 * @return boolean
 *
 */
function check_database_connection()
{
    try {
        DB::connection(config('database.default'))->reconnect();
        return true;
    } catch (Exception $ex) {
        return false;
    }
}

if (!function_exists('language_flag')) {
    /**
     * @return string
     * @param $flag
     * @param $name
     *
     */
    function language_flag($flag, $name = null)
    {
        return Html::image(url(BASE_LANGUAGE_FLAG_PATH . $flag . '.png'), $name, ['title' => $name]);
    }
}

if (!function_exists('sanitize_html_class')) {
    /**
     * @param $class
     * @param string $fallback
     * @return mixed
     */
    function sanitize_html_class($class, $fallback = '')
    {
        //Strip out any % encoded octets
        $sanitized = preg_replace('|%[a-fA-F0-9][a-fA-F0-9]|', '', $class);

        //Limit to A-Z,a-z,0-9,_,-
        $sanitized = preg_replace('/[^A-Za-z0-9_-]/', '', $sanitized);

        if ('' == $sanitized && $fallback) {
            return sanitize_html_class($fallback);
        }
        /**
         * Filters a sanitized HTML class string.
         *
         * @since 2.8.0
         *
         * @param string $sanitized The sanitized HTML class.
         * @param string $class HTML class before sanitization.
         * @param string $fallback The fallback string.
         */
        return apply_filters('sanitize_html_class', $sanitized, $class, $fallback);
    }
}


if (!function_exists('parse_args')) {
    /**
     * @param $args
     * @param string $defaults
     * @return array
     */
    function parse_args($args, $defaults = '')
    {
        if (is_object($args)) {
            $result = get_object_vars($args);
        } else {
            $result =& $args;
        }

        if (is_array($defaults)) {
            return array_merge($defaults, $result);
        }

        return $result;
    }
}

if (!function_exists('is_plugin_active')) {
    /**
     * @param $alias
     * @return bool
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    function is_plugin_active($alias)
    {
        $path = plugin_path($alias);

        if (!File::isDirectory($path)) {
            return false;
        }

        $content = get_file_data($path . '/plugin.json');
        if (empty($content)) {
            return false;
        }

        return class_exists($content['provider']);
    }
}

if (!function_exists('render_editor')) {
    /**
     * @param $name
     * @param null $value
     * @param bool $with_short_code
     * @param array $attributes
     * @return string
     *
     * @throws Throwable
     */
    function render_editor($name, $value = null, $with_short_code = false, array $attributes = [])
    {
        $editor = new Editor;

        return $editor->render($name, $value, $with_short_code, $attributes);
    }
}

if (!function_exists('is_in_admin')) {
    /**
     * @return bool
     */
    function is_in_admin()
    {
        return request()->segment(1) === config('core.base.general.admin_dir');
    }
}

if (!function_exists('admin_bar')) {
    /**
     * @return Botble\Base\Supports\AdminBar
     */
    function admin_bar()
    {
        return AdminBarFacade::getFacadeRoot();
    }
}

if (!function_exists('page_title')) {
    /**
     * @return PageTitle
     */
    function page_title()
    {
        return PageTitleFacade::getFacadeRoot();
    }
}

if (!function_exists('dashboard_menu')) {
    /**
     * @return \Botble\Base\Supports\DashboardMenu
     */
    function dashboard_menu()
    {
        return DashboardMenuFacade::getFacadeRoot();
    }
}

if (!function_exists('html_attribute_element')) {
    /**
     * @param $key
     * @param $value
     * @return string
     *
     */
    function html_attribute_element($key, $value)
    {
        if (is_numeric($key)) {
            return $value;
        }

        // Treat boolean attributes as HTML properties
        if (is_bool($value) && $key != 'value') {
            return $value ? $key : '';
        }

        if (!empty($value)) {
            return $key . '="' . e($value) . '"';
        }
    }
}

if (!function_exists('html_attributes_builder')) {
    /**
     * @param array $attributes
     * @return string
     *
     */
    function html_attributes_builder(array $attributes)
    {
        $html = [];

        foreach ((array)$attributes as $key => $value) {
            $element = html_attribute_element($key, $value);

            if (!empty($element)) {
                $html[] = $element;
            }
        }

        return count($html) > 0 ? ' ' . implode(' ', $html) : '';
    }
}

if (!function_exists('scan_language_keys')) {
    /**
     * Scan all __() function then save key to /storage/languages.json
     *
     * @param $key
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    function scan_language_keys($key)
    {
        if (!empty($key)) {
            $languages = [];
            $stored_file = storage_path('languages.json');
            if (file_exists($stored_file)) {
                $languages = get_file_data($stored_file, true);
            }
            $languages[$key] = $key;
            save_file_data($stored_file, $languages, true);
        }
    }
}

if (!function_exists('remove_query_string_var')) {
    /**
     * @param $url
     * @param $key
     * @return bool|mixed|string
     *
     */
    function remove_query_string_var($url, $key)
    {
        if (!is_array($key)) {
            $key = [$key];
        }
        foreach ($key as $item) {
            $url = preg_replace('/(.*)(?|&)' . $item . '=[^&]+?(&)(.*)/i', '$1$2$4', $url . '&');
            $url = substr($url, 0, -1);
        }
        return $url;
    }
}

if (!function_exists('array_equal')) {
    /**
     * @param array $a
     * @param array $b
     * @return bool
     */
    function array_equal(array $first, array $second)
    {
        if (count($first) != count($second)) {
            return false;
        }

        $checkValue = (!array_diff($first, $second) && !array_diff($second, $first));

        return $checkValue;
    }
}

if (!function_exists('array_equal_with_key')) {
    /**
     * @param array $first
     * @param array $second
     * @return bool
     */
    function array_equal_with_key(array $first, array $second)
    {
        if (count($first) != count($second)) {
            return false;
        }

        $checkValue = (!array_diff($first, $second) && !array_diff($second, $first));

        $checkKey = (!array_diff_key($first, $second) && !array_diff_key($second, $first));

        return $checkKey && $checkValue;
    }
}

if (!function_exists('get_active_plugins')) {
    /**
     * @return array
     *
     */
    function get_active_plugins()
    {
        return json_decode(setting('activated_plugins', '[]'), true);
    }
}

if (!function_exists('get_cms_version')) {
    /**
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    function get_cms_version()
    {
        try {
            return trim(get_file_data(core_path('/VERSION'), false));
        } catch (Exception $exception) {
            return '3.4';
        }
    }
}

if (!function_exists('platform_path')) {
    /**
     * @return string
     *
     */
    function platform_path($path = null)
    {
        return base_path('platform' . DIRECTORY_SEPARATOR . $path);
    }
}

if (!function_exists('core_path')) {
    /**
     * @return string
     *
     */
    function core_path($path = null)
    {
        return platform_path('core' . DIRECTORY_SEPARATOR . $path);
    }
}

if (!function_exists('plugin_path')) {
    /**
     * @return string
     *
     */
    function plugin_path($path = null)
    {
        return platform_path('plugins' . DIRECTORY_SEPARATOR . $path);
    }
}

if (!function_exists('package_path')) {
    /**
     * @return string
     *
     */
    function package_path($path = null)
    {
        return platform_path('packages' . DIRECTORY_SEPARATOR . $path);
    }
}