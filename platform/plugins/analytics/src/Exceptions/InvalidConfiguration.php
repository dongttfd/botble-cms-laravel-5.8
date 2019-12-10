<?php

namespace Botble\Analytics\Exceptions;

use Exception;

class InvalidConfiguration extends Exception
{
    /**
     * @return static
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function viewIdNotSpecified()
    {
        return new static(trans('plugins/analytics::analytics.view_id_not_specified', ['version' => get_cms_version()]));
    }

    /**
     * @return static
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function credentialsIsNotValid()
    {
        return new static(trans('plugins/analytics::analytics.credential_is_not_valid', ['version' => get_cms_version()]));
    }
}
