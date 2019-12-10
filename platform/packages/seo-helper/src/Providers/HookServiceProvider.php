<?php

namespace Botble\SeoHelper\Providers;

use Assets;
use Illuminate\Support\ServiceProvider;
use SeoHelper;

class HookServiceProvider extends ServiceProvider
{
    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Boot the service provider.
     *
     */
    public function boot()
    {
        add_action(BASE_ACTION_META_BOXES, [$this, 'addMetaBox'], 12, 3);
        add_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, [$this, 'setSeoMeta'], 56, 2);
    }

    /**
     * @param $screen
     *
     */
    public function addMetaBox($screen)
    {
        if (in_array($screen, config('packages.seo-helper.general.supported'))) {
            Assets::addScriptsDirectly('vendor/core/packages/seo-helper/js/seo-helper.js');
            add_meta_box('seo_wrap', trans('packages/seo-helper::seo-helper.meta_box_header'), [$this, 'seoMetaBox'],
                $screen, 'advanced', 'low');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function seoMetaBox()
    {
        $meta = [
            'seo_title'       => null,
            'seo_description' => null,
        ];

        $args = func_get_args();
        if (!empty($args[0])) {
            $meta_data = get_meta_data($args[0]->id, 'seo_meta', $args[1], true);
        }

        if (!empty($meta_data) && is_array($meta_data)) {
            $meta = array_merge($meta, $meta_data);
        }

        $object = $args[0];

        return view('packages/seo-helper::meta_box', compact('meta', 'object'));
    }

    /**
     * @param $screen
     * @param $object
     *
     */
    public function setSeoMeta($screen, $object)
    {
        $meta = get_meta_data($object->id, 'seo_meta', $screen, true);
        if (!empty($meta)) {
            if (!empty($meta['seo_title'])) {
                SeoHelper::setTitle($meta['seo_title']);
            }

            if (!empty($meta['seo_description'])) {
                SeoHelper::setDescription($meta['seo_description']);
            }
        }
    }
}
