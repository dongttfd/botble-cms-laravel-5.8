<?php

use Botble\CustomField\Repositories\Interfaces\CustomFieldInterface;
use Illuminate\Support\Arr;

if (!function_exists('get_field')) {
    /**
     * @param int $id
     * @param string $screenName
     * @param null $alias
     * @param null $default
     * @return mixed
     */
    function get_field($id, $screenName, $alias = null, $default = null)
    {
        $customFieldRepository = app(CustomFieldInterface::class);

        if ($alias === null || !trim($alias)) {
            return $customFieldRepository->getFirstBy([
                'use_for'    => $screenName,
                'use_for_id' => $id,
            ]);
        }

        $field = $customFieldRepository->getFirstBy([
            'use_for'    => $screenName,
            'use_for_id' => $id,
            'slug'       => $alias,
        ]);

        if (!$field || !$field->resolved_value) {
            return $default;
        }

        return $field->resolved_value;
    }
}

if (!function_exists('has_field')) {
    /**
     * @param int $id
     * @param string $screenName
     * @param null $alias
     * @return bool
     */
    function has_field($id, $screenName, $alias = null)
    {
        if (!get_field($id, $screenName, $alias)) {
            return false;
        }
        return true;
    }
}

if (!function_exists('get_sub_field')) {
    /**
     * @param array $parentField
     * @param $alias
     * @param null $default
     * @return mixed
     */
    function get_sub_field(array $parentField, $alias, $default = null)
    {
        foreach ($parentField as $field) {
            if (Arr::get($field, 'slug') === $alias) {
                return Arr::get($field, 'value', $default);
            }
        }
        return $default;
    }
}

if (!function_exists('has_sub_field')) {
    /**
     * @param array $parentField
     * @param $alias
     * @return bool
     */
    function has_sub_field(array $parentField, $alias)
    {
        if (!get_sub_field($parentField, $alias)) {
            return false;
        }
        return true;
    }
}
