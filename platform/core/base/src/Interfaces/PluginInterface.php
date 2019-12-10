<?php

namespace Botble\Base\Interfaces;

interface PluginInterface
{

    /**
     *
     */
    public static function activate();

    /**
     *
     */
    public static function deactivate();

    /**
     *
     */
    public static function remove();
}
