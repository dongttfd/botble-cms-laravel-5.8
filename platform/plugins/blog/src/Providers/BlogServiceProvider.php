<?php

namespace Botble\Blog\Providers;

use Illuminate\Routing\Events\RouteMatched;
use Botble\Base\Supports\Helper;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Blog\Models\Post;
use Botble\Blog\Repositories\Caches\PostCacheDecorator;
use Botble\Blog\Repositories\Eloquent\PostRepository;
use Botble\Blog\Repositories\Interfaces\PostInterface;
use Botble\Shortcode\View\View;
use Event;
use Illuminate\Support\ServiceProvider;
use Botble\Blog\Models\Category;
use Botble\Blog\Repositories\Caches\CategoryCacheDecorator;
use Botble\Blog\Repositories\Eloquent\CategoryRepository;
use Botble\Blog\Repositories\Interfaces\CategoryInterface;
use Botble\Blog\Models\Tag;
use Botble\Blog\Repositories\Caches\TagCacheDecorator;
use Botble\Blog\Repositories\Eloquent\TagRepository;
use Botble\Blog\Repositories\Interfaces\TagInterface;
use Language;
use SeoHelper;

/**
 * Class BlogServiceProvider
 * @package Botble\Blog
 *
 * @since 02/07/2016 09:50 AM
 */
class BlogServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     *
     */
    public function register()
    {
        $this->app->bind(PostInterface::class, function () {
            return new PostCacheDecorator(new PostRepository(new Post));
        });

        $this->app->bind(CategoryInterface::class, function () {
            return new CategoryCacheDecorator(new CategoryRepository(new Category));
        });

        $this->app->bind(TagInterface::class, function () {
            return new TagCacheDecorator(new TagRepository(new Tag));
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    /**
     * Boot the service provider.
     *
     */
    public function boot()
    {
        $this->setNamespace('plugins/blog')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadMigrations()
            ->publishPublicFolder()
            ->publishAssetsFolder();

        if (defined('MEMBER_MODULE_SCREEN_NAME')) {
            $this->loadRoutes(['member']);
        }

        $this->app->register(RouteServiceProvider::class);
        $this->app->register(HookServiceProvider::class);
        $this->app->register(EventServiceProvider::class);

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()
                ->registerItem([
                    'id'          => 'cms-plugins-blog',
                    'priority'    => 3,
                    'parent_id'   => null,
                    'name'        => 'plugins/blog::base.menu_name',
                    'icon'        => 'fa fa-edit',
                    'url'         => route('posts.list'),
                    'permissions' => ['posts.list'],
                ])
                ->registerItem([
                    'id'          => 'cms-plugins-blog-post',
                    'priority'    => 1,
                    'parent_id'   => 'cms-plugins-blog',
                    'name'        => 'plugins/blog::posts.menu_name',
                    'icon'        => null,
                    'url'         => route('posts.list'),
                    'permissions' => ['posts.list'],
                ])
                ->registerItem([
                    'id'          => 'cms-plugins-blog-categories',
                    'priority'    => 2,
                    'parent_id'   => 'cms-plugins-blog',
                    'name'        => 'plugins/blog::categories.menu_name',
                    'icon'        => null,
                    'url'         => route('categories.list'),
                    'permissions' => ['categories.list'],
                ])
                ->registerItem([
                    'id'          => 'cms-plugins-blog-tags',
                    'priority'    => 3,
                    'parent_id'   => 'cms-plugins-blog',
                    'name'        => 'plugins/blog::tags.menu_name',
                    'icon'        => null,
                    'url'         => route('tags.list'),
                    'permissions' => ['tags.list'],
                ]);
        });

        $screens = [POST_MODULE_SCREEN_NAME, CATEGORY_MODULE_SCREEN_NAME, TAG_MODULE_SCREEN_NAME];

        if (defined('MEMBER_MODULE_SCREEN_NAME')) {
            $screens[] = MEMBER_POST_MODULE_SCREEN_NAME;
        }

        if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
            Language::registerModule($screens);
        }

        $this->app->booted(function () use ($screens) {
            config([
                'packages.slug.general.supported' => array_merge(config('packages.slug.general.supported'), $screens),
            ]);
            config(['packages.slug.general.prefixes.' . TAG_MODULE_SCREEN_NAME => 'tag']);

            SeoHelper::registerModule($screens);
        });

        view()->composer([
            'plugins/blog::themes.post',
            'plugins/blog::themes.category',
            'plugins/blog::themes.tag',
        ], function (View $view) {
            $view->withShortcodes();
        });
    }
}
