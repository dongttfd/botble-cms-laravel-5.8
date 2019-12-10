<?php

if (!function_exists('esc_sql')) {
    /**
     * @param $string
     * @return string
     */
    function esc_sql($string)
    {
        return app('db')->getPdo()->quote($string);
    }
}
