<?php

use PragmaRX\Countries\Package\Countries;

if (!function_exists('get_list_countries')) {
    /**
     * @return mixed
     *
     */
    function get_list_countries()
    {
        return Countries::all()->pluck('name.common', 'cca2');
    }
}

if (!function_exists('get_country_name_by_code')) {
    /**
     * @param $code
     * @return null
     *
     */
    function get_country_name_by_code($code)
    {
        $country = Countries::where('cca2', $code)->first();
        if (!empty($country) && count($country) > 0) {
            return $country->name->common;
        }
        return null;
    }
}
