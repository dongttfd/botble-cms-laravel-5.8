<?php

namespace Botble\Block\Providers;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Block\Repositories\Interfaces\BlockInterface;
use Illuminate\Support\ServiceProvider;

class HookServiceProvider extends ServiceProvider
{
    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     *
     */
    public function boot()
    {
        add_shortcode('static-block', __('Static Block'), __('Add a custom static block'), [$this, 'render']);
        //shortcode()->setAdminConfig('static-block', view('plugins/block::partials.short-code-admin-config')->render());
    }

    /**
     * @param \stdClass $shortcode
     * @return null
     *
     */
    public function render($shortcode)
    {
        $block = $this->app->make(BlockInterface::class)
            ->getFirstBy([
                'alias'  => $shortcode->alias,
                'status' => BaseStatusEnum::PUBLISHED,
            ]);

        if (empty($block)) {
            return null;
        }

        return $block->content;
    }
}
