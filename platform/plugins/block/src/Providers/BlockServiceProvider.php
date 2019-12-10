<?php

namespace Botble\Block\Providers;

use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Block\Models\Block;
use Event;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\ServiceProvider;
use Botble\Block\Repositories\Caches\BlockCacheDecorator;
use Botble\Block\Repositories\Eloquent\BlockRepository;
use Botble\Block\Repositories\Interfaces\BlockInterface;
use Botble\Base\Supports\Helper;
use Language;

class BlockServiceProvider extends ServiceProvider
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
        $this->app->bind(BlockInterface::class, function () {
            return new BlockCacheDecorator(new BlockRepository(new Block));
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    /**
     *
     */
    public function boot()
    {
        $this->setNamespace('plugins/block')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadAndPublishTranslations()
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadMigrations();

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-block',
                'priority'    => 6,
                'parent_id'   => null,
                'name'        => 'plugins/block::block.menu',
                'icon'        => 'fa fa-code',
                'url'         => route('block.list'),
                'permissions' => ['block.list'],
            ]);
        });

        $this->app->register(HookServiceProvider::class);

        if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
            Language::registerModule([BLOCK_MODULE_SCREEN_NAME]);
        }
    }
}
