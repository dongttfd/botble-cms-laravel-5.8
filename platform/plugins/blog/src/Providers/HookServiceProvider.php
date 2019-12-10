<?php

namespace Botble\Blog\Providers;

use Assets;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Dashboard\Supports\DashboardWidgetInstance;
use Illuminate\Routing\Events\RouteMatched;
use Botble\Base\Supports\Helper;
use Botble\Page\Models\Page;
use Botble\Page\Repositories\Interfaces\PageInterface;
use Botble\SeoHelper\SeoOpenGraph;
use Eloquent;
use Event;
use Html;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Botble\Blog\Repositories\Interfaces\CategoryInterface;
use Botble\Blog\Repositories\Interfaces\TagInterface;
use Illuminate\Support\Str;
use Menu;
use Botble\Blog\Repositories\Interfaces\PostInterface;
use Auth;
use SeoHelper;
use Theme;

class HookServiceProvider extends ServiceProvider
{
    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Boot the service provider.
     *
     * @throws \Throwable
     */
    public function boot()
    {
        if (defined('MENU_ACTION_SIDEBAR_OPTIONS')) {
            add_action(MENU_ACTION_SIDEBAR_OPTIONS, [$this, 'registerMenuOptions'], 2);
        }
        add_filter(DASHBOARD_FILTER_ADMIN_LIST, [$this, 'registerDashboardWidgets'], 21, 2);
        add_filter(BASE_FILTER_PUBLIC_SINGLE_DATA, [$this, 'handleSingleView'], 2, 1);
        if (defined('PAGE_MODULE_SCREEN_NAME')) {
            add_filter(PAGE_FILTER_FRONT_PAGE_CONTENT, [$this, 'renderBlogPage'], 2, 2);
            add_filter(BASE_FILTER_AFTER_SETTING_CONTENT, [$this, 'addSettings'], 47, 1);
            add_filter(PAGE_FILTER_PAGE_NAME_IN_ADMIN_LIST, [$this, 'addAdditionNameToPageName'], 147, 2);
        }

        Event::listen(RouteMatched::class, function () {
            admin_bar()->registerLink('Post', route('posts.create'), 'add-new');
        });

        if (function_exists('add_shortcode')) {
            add_shortcode('blog-posts', __('Blog posts'), __('Add blog posts'), [$this, 'renderBlogPosts']);
            shortcode()->setAdminConfig('blog-posts',
                view('plugins/blog::partials.posts-short-code-admin-config')->render());
        }

        if (defined('MEMBER_MODULE_SCREEN_NAME')) {
            add_filter(MEMBER_TOP_MENU_FILTER, [$this, 'addMenuToMemberPage'], 12, 1);
            add_filter(MEMBER_TOP_STATISTIC_FILTER, [$this, 'addStatisticToMemberPage'], 12, 1);
        }
    }

    /**
     * Register sidebar options in menu
     * @throws \Throwable
     */
    public function registerMenuOptions()
    {
        if (Auth::user()->hasPermission('categories.list')) {
            $categories = Menu::generateSelect([
                'model'   => $this->app->make(CategoryInterface::class)->getModel(),
                'screen'  => CATEGORY_MODULE_SCREEN_NAME,
                'theme'   => false,
                'options' => [
                    'class' => 'list-item',
                ],
            ]);
            echo view('plugins/blog::categories.partials.menu-options', compact('categories'));
        }

        if (Auth::user()->hasPermission('tags.list')) {
            $tags = Menu::generateSelect([
                'model'   => $this->app->make(TagInterface::class)->getModel(),
                'screen'  => TAG_MODULE_SCREEN_NAME,
                'theme'   => false,
                'options' => [
                    'class' => 'list-item',
                ],
            ]);
            echo view('plugins/blog::tags.partials.menu-options', compact('tags'));
        }
    }

    /**
     * @param array $widgets
     * @param Collection $widgetSettings
     * @return array
     * @throws \Throwable
     *
     */
    public function registerDashboardWidgets($widgets, $widgetSettings)
    {
        if (!Auth::user()->hasPermission('posts.list')) {
            return $widgets;
        }

        Assets::addScriptsDirectly(['/vendor/core/plugins/blog/js/blog.js']);

        $widget = new DashboardWidgetInstance;

        $widget->permission = 'posts.list';
        $widget->key = 'widget_posts_recent';
        $widget->title = trans('plugins/blog::posts.widget_posts_recent');
        $widget->icon = 'fas fa-edit';
        $widget->color = '#f3c200';
        $widget->route = route('posts.widget.recent-posts');
        $widget->bodyClass = 'scroll-table';
        $widget->column = 'col-md-6 col-sm-6';

        return $widget->init($widgets, $widgetSettings);
    }

    /**
     * @param Eloquent $slug
     * @return array|Eloquent
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handleSingleView($slug)
    {
        if ($slug instanceof Eloquent) {
            $data = [];
            switch ($slug->reference) {
                case POST_MODULE_SCREEN_NAME:
                    $post = $this->app->make(PostInterface::class)
                        ->getFirstBy([
                            'id'     => $slug->reference_id,
                            'status' => BaseStatusEnum::PUBLISHED,
                        ]);
                    if (!empty($post)) {
                        Helper::handleViewCount($post, 'viewed_post');

                        SeoHelper::setTitle($post->name)->setDescription($post->description);

                        $meta = new SeoOpenGraph();
                        if ($post->image) {
                            $meta->setImage(url($post->image));
                        }
                        $meta->setDescription($post->description);
                        $meta->setUrl(route('public.single', $slug->key));
                        $meta->setTitle($post->name);
                        $meta->setType('article');

                        SeoHelper::setSeoOpenGraph($meta);

                        admin_bar()->registerLink(trans('plugins/blog::posts.edit_this_post'),
                            route('posts.edit', $post->id));

                        Theme::breadcrumb()->add(__('Home'), url('/'))->add($post->name,
                            route('public.single', $slug->key));

                        do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, POST_MODULE_SCREEN_NAME, $post);

                        $data = [
                            'view'         => 'post',
                            'default_view' => 'plugins/blog::themes.post',
                            'data'         => compact('post'),
                            'slug'         => $post->slug,
                        ];
                    }
                    break;
                case CATEGORY_MODULE_SCREEN_NAME:
                    $category = $this->app->make(CategoryInterface::class)
                        ->getFirstBy([
                            'id'     => $slug->reference_id,
                            'status' => BaseStatusEnum::PUBLISHED,
                        ]);
                    if (!empty($category)) {
                        SeoHelper::setTitle($category->name)->setDescription($category->description);

                        $meta = new SeoOpenGraph();
                        if ($category->image) {
                            $meta->setImage(url($category->image));
                        }
                        $meta->setDescription($category->description);
                        $meta->setUrl(route('public.single', $slug->key));
                        $meta->setTitle($category->name);
                        $meta->setType('article');

                        SeoHelper::setSeoOpenGraph($meta);

                        admin_bar()->registerLink(trans('plugins/blog::categories.edit_this_category'),
                            route('categories.edit', $category->id));

                        $allRelatedCategoryIds = array_unique(array_merge($this->app->make(CategoryInterface::class)->getAllRelatedChildrenIds($category),
                            [$category->id]));

                        $posts = $this->app->make(PostInterface::class)->getByCategory($allRelatedCategoryIds, 12);

                        Theme::breadcrumb()->add(__('Home'), url('/'))->add($category->name,
                            route('public.single', $slug->key));

                        do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, CATEGORY_MODULE_SCREEN_NAME, $category);

                        return [
                            'view'         => 'category',
                            'default_view' => 'plugins/blog::themes.category',
                            'data'         => compact('category', 'posts'),
                            'slug'         => $category->slug,
                        ];
                    }
                    break;
            }
            if (!empty($data)) {
                return $data;
            }
        }

        return $slug;
    }

    /**
     * @param \stdClass $shortcode
     * @return \Response
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \Throwable
     */
    public function renderBlogPosts($shortcode)
    {
        $query = $this->app->make(PostInterface::class)
            ->getModel()
            ->select('posts.*')
            ->where(['posts.status' => BaseStatusEnum::PUBLISHED]);

        $posts = $this->app->make(PostInterface::class)
            ->applyBeforeExecuteQuery($query, POST_MODULE_SCREEN_NAME)
            ->paginate($shortcode->paginate ?? 12);

        $view = 'plugins/blog::themes.templates.posts';
        $theme_view = 'theme.' . setting('theme') . '::views.templates.posts';
        if (view()->exists($theme_view)) {
            $view = $theme_view;
        }

        return view($view, compact('posts'))->render();
    }

    /**
     * @param string|null $content
     * @param Page $page
     * @throws \Throwable
     */
    public function renderBlogPage(?string $content, Page $page)
    {
        if ($page->id == setting('blog_page_id')) {
            $view = 'plugins/blog::themes.loop';

            if (view()->exists('theme.' . setting('theme') . '::views.loop')) {
                $view = 'theme.' . setting('theme') . '::views.loop';
            }
            return view($view, ['posts' => get_all_posts()])->render();
        }

        return $content;
    }

    /**
     * @param null $data
     * @return string
     * @throws \Throwable
     */
    public function addSettings($data = null)
    {
        $pages = $this->app->make(PageInterface::class)
            ->allBy(['status' => BaseStatusEnum::PUBLISHED], [], ['pages.id', 'pages.name']);

        return $data . view('plugins/blog::settings', compact('pages'))->render();
    }

    /**
     * @param string|null $name
     * @param Page $page
     * @return string|null
     */
    public function addAdditionNameToPageName(?string $name, Page $page)
    {
        if ($page->id == setting('blog_page_id')) {
            $subTitle = Html::tag('span', trans('plugins/blog::base.blog_page'), ['class' => 'additional-page-name'])
                ->toHtml();
            if (Str::contains($name, '— ')) {
                return $name . ', ' . $subTitle;
            }

            return $name . '— ' . $subTitle;
        }

        return $name;
    }

    /**
     * @param $view
     * @return string
     * @throws \Throwable
     */
    public function addMenuToMemberPage($view)
    {
        return $view . view('plugins/blog::members.menu')->render();
    }

    /**
     * @param $view
     * @return string
     * @throws \Throwable
     */
    public function addStatisticToMemberPage($view)
    {
        $user = Auth::guard('member')->user();

        return $view . view('plugins/blog::members.statistic', compact('user'))->render();
    }
}
