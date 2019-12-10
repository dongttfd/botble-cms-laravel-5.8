<?php

namespace Botble\Blog;

use Botble\Dashboard\Repositories\Interfaces\DashboardWidgetInterface;
use Schema;
use Botble\Base\Interfaces\PluginInterface;

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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('post_tags');
        Schema::dropIfExists('post_categories');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('tags');

        app(DashboardWidgetInterface::class)->deleteBy(['name' => 'widget_posts_recent']);
    }
}
