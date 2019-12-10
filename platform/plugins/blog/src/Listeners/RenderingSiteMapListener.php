<?php

namespace Botble\Blog\Listeners;

use Botble\Blog\Repositories\Interfaces\CategoryInterface;
use Botble\Blog\Repositories\Interfaces\PostInterface;
use Botble\Blog\Repositories\Interfaces\TagInterface;
use SiteMapManager;

class RenderingSiteMapListener
{
    /**
     * @var PostInterface
     */
    protected $postRepository;

    /**
     * @var CategoryInterface
     */
    protected $categoryRepository;

    /**
     * @var TagInterface
     */
    protected $tagRepository;

    /**
     * RenderingSiteMapListener constructor.
     * @param PostInterface $postRepository
     * @param CategoryInterface $categoryRepository
     * @param TagInterface $tagRepository
     */
    public function __construct(
        PostInterface $postRepository,
        CategoryInterface $categoryRepository,
        TagInterface $tagRepository
    ) {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
    }

    /**
     * Handle the event.
     *
     * @return void
     *
     */
    public function handle()
    {
        $posts = $this->postRepository->getDataSiteMap();

        foreach ($posts as $post) {
            SiteMapManager::add(route('public.single', $post->slug), $post->updated_at, '0.8', 'daily');
        }

        // get all categories from db
        $categories = $this->categoryRepository->getDataSiteMap();

        // add every category to the site map
        foreach ($categories as $category) {
            SiteMapManager::add(route('public.single', $category->slug), $category->updated_at, '0.8', 'daily');
        }

        // get all tags from db
        $tags = $this->tagRepository->getDataSiteMap();

        // add every tag to the site map
        foreach ($tags as $tag) {
            SiteMapManager::add(route('public.tag', $tag->slug), $tag->updated_at, '0.3', 'weekly');
        }
    }
}
