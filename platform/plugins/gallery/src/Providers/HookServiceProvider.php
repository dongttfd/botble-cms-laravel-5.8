<?php

namespace Botble\Gallery\Providers;

use Assets;
use Illuminate\Support\ServiceProvider;

class HookServiceProvider extends ServiceProvider
{
    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     *
     * @throws \Throwable
     */
    public function boot()
    {
        add_action(BASE_ACTION_META_BOXES, [$this, 'addGalleryBox'], 13, 3);
        add_shortcode('gallery', trans('plugins/gallery::gallery.gallery_images'), trans('plugins/gallery::gallery.add_gallery_short_code'), [$this, 'render']);
        shortcode()->setAdminConfig('gallery', view('plugins/gallery::partials.short-code-admin-config')->render());
    }

    /**
     * @param string $screen
     *
     */
    public function addGalleryBox(string $screen)
    {
        if (in_array($screen, config('plugins.gallery.general.supported'))) {
            Assets::addStylesDirectly(['vendor/core/plugins/gallery/css/admin-gallery.css']);
            add_meta_box('gallery_wrap', trans('plugins/gallery::gallery.gallery_box'), [$this, 'galleryMetaField'], $screen, 'advanced', 'default');
        }
    }

    /**
     *
     * @throws \Throwable
     * @return string
     */
    public function galleryMetaField()
    {
        $value = null;
        $args = func_get_args();
        if (!empty($args[0])) {
            $value = gallery_meta_data($args[0]->id, $args[1]);
        }

        return view('plugins/gallery::gallery-box', compact('value'))->render();
    }

    /**
     * @param $shortcode
     * @return string
     *
     */
    public function render($shortcode)
    {
        return render_galleries($shortcode->limit);
    }
}
