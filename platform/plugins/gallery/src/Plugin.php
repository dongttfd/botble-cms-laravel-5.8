<?php

namespace Botble\Gallery;

use Botble\Base\Interfaces\PluginInterface;
use Schema;

class Plugin implements PluginInterface
{
    /**
     *
     */
    public static function activate()
    {
    }

    /**
     *
     */
    public static function deactivate()
    {
    }

    /**
     *
     */
    public static function remove()
    {
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('gallery_meta');
    }
}
