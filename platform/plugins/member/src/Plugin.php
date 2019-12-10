<?php

namespace Botble\Member;

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
        Schema::dropIfExists('members');
        Schema::dropIfExists('member_password_resets');
    }
}
