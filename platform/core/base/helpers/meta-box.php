<?php

if (!function_exists('add_meta_box')) {
    /**
     * @param $id
     * @param $title
     * @param $callback
     * @param null $screen
     * @param string $context
     * @param string $priority
     * @param null $callback_args
     *
     */
    function add_meta_box(
        $id,
        $title,
        $callback,
        $screen = null,
        $context = 'advanced',
        $priority = 'default',
        $callback_args = null
    ) {
        MetaBox::addMetaBox($id, $title, $callback, $screen, $context, $priority, $callback_args);
    }
}


if (!function_exists('get_meta_data')) {
    /**
     * @param $id
     * @param $key
     * @param $screen
     * @param boolean $single
     * @param array $select
     * @return mixed
     *
     */
    function get_meta_data($id, $key, $screen, $single = false, $select = ['meta_value'])
    {
        return MetaBox::getMetaData($id, $key, $screen, $single, $select);
    }
}

if (!function_exists('get_meta')) {
    /**
     * @param $id
     * @param $key
     * @param $screen
     * @param array $select
     * @return mixed
     *
     */
    function get_meta($id, $key, $screen, $select = ['meta_value'])
    {
        return MetaBox::getMeta($id, $key, $screen, $select);
    }
}

if (!function_exists('save_meta_data')) {
    /**
     * @param $id
     * @param $key
     * @param $screen
     * @param $value
     * @param $options
     * @return mixed
     *
     */
    function save_meta_data($id, $key, $value, $screen, $options = null)
    {
        return MetaBox::saveMetaBoxData($id, $key, $value, $screen, $options);
    }
}

if (!function_exists('delete_meta_data')) {
    /**
     * @param $id
     * @param $key
     * @param $screen
     * @return mixed
     *
     */
    function delete_meta_data($id, $key, $screen)
    {
        return MetaBox::deleteMetaData($id, $key, $screen);
    }
}
