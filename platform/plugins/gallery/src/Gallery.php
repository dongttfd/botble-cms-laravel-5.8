<?php

namespace Botble\Gallery;

use Botble\Gallery\Repositories\Interfaces\GalleryMetaInterface;
use Theme;

class Gallery
{
    /**
     * @var GalleryMetaInterface
     */
    protected $galleryMetaRepository;

    /**
     * Gallery constructor.
     *
     * @param GalleryMetaInterface $galleryMetaRepository
     */
    public function __construct(GalleryMetaInterface $galleryMetaRepository)
    {
        $this->galleryMetaRepository = $galleryMetaRepository;
    }

    /**
     * @param string | array $screen
     * @return Gallery
     *
     */
    public function registerModule($screen)
    {
        if (!is_array($screen)) {
            $screen = [$screen];
        }
        config([
            'plugins.gallery.general.supported' => array_merge(config('plugins.gallery.general.supported'), $screen),
        ]);

        return $this;
    }

    /**
     * @param string $screen
     * @param \Illuminate\Http\Request $request
     * @param \Eloquent|false $data
     */
    public function saveGallery($screen, $request, $data)
    {
        if ($data != false && in_array($screen, config('plugins.gallery.general.supported'))) {
            if (empty($request->input('gallery'))) {
                $this->galleryMetaRepository->deleteBy([
                    'content_id' => $data->id,
                    'reference'  => $screen,
                ]);
            }
            $meta = $this->galleryMetaRepository->getFirstBy([
                'content_id' => $data->id,
                'reference'  => $screen,
            ]);
            if (!$meta) {
                $meta = $this->galleryMetaRepository->getModel();
                $meta->content_id = $data->id;
                $meta->reference = $screen;
            }

            $meta->images = $request->input('gallery');
            $this->galleryMetaRepository->createOrUpdate($meta);
        }
    }

    /**
     * @param string $screen
     * @param \Eloquent|false $data
     */
    public function deleteGallery($screen, $data)
    {
        if (in_array($screen, config('plugins.gallery.general.supported'))) {
            $this->galleryMetaRepository->deleteBy([
                'content_id' => $data->id,
                'reference'  => $screen,
            ]);
        }
        
        return true;
    }

    /**
     * @return $this
     *
     */
    public function registerAssets()
    {
        Theme::asset()
            ->usePath(false)
            ->add('lightgallery-css', 'vendor/core/plugins/gallery/css/lightgallery.min.css')
            ->add('gallery-css', 'vendor/core/plugins/gallery/css/gallery.css');

        Theme::asset()
            ->container('footer')
            ->add('lightgallery-js', 'vendor/core/plugins/gallery/js/lightgallery.min.js', ['jquery'])
            ->add('imagesloaded', 'vendor/core/plugins/gallery/js/imagesloaded.pkgd.min.js', ['jquery'])
            ->add('masonry', 'vendor/core/plugins/gallery/js/masonry.pkgd.min.js', ['jquery'])
            ->add('gallery-js', 'vendor/core/plugins/gallery/js/gallery.js', ['jquery']);

        return $this;
    }
}
