<?php

namespace Botble\Blog\Listeners;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Blog\Repositories\Interfaces\CategoryInterface;
use Botble\Blog\Repositories\Interfaces\PostInterface;
use Botble\Blog\Repositories\Interfaces\TagInterface;
use JsonFeedManager;

class RenderingJsonFeedListener
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
        $posts = $this->postRepository->getAllPosts(true);

        foreach ($posts as $post) {
            JsonFeedManager::addItem('posts', [
                'id'             => $post->id,
                'title'          => $post->name,
                'url'            => route('public.single', $post->slug),
                'image'          => $post->image,
                'content_html'   => $post->content,
                'date_published' => $post->created_at->tz('UTC')->toRfc3339String(),
                'date_modified'  => $post->updated_at->tz('UTC')->toRfc3339String(),
                'author'         => [
                    'name' => $post->author ? $post->author->name : null,
                ],
            ]);
        }

        $categories = $this->categoryRepository->getAllCategories(['status' => BaseStatusEnum::PUBLISHED]);

        foreach ($categories as $category) {
            JsonFeedManager::addItem('categories', [
                'id'             => $category->id,
                'title'          => $category->name,
                'url'            => route('public.single', $category->slug),
                'image'          => null,
                'content_html'   => $category->description,
                'date_published' => $category->created_at->tz('UTC')->toRfc3339String(),
                'date_modified'  => $category->updated_at->tz('UTC')->toRfc3339String(),
            ]);
        }

        $tags = $this->tagRepository->getAllTags(true);

        foreach ($tags as $tag) {
            JsonFeedManager::addItem('tags', [
                'id'             => $tag->id,
                'title'          => $tag->name,
                'url'            => route('public.single', $tag->slug),
                'image'          => null,
                'content_html'   => $tag->description,
                'date_published' => $tag->created_at->tz('UTC')->toRfc3339String(),
                'date_modified'  => $tag->updated_at->tz('UTC')->toRfc3339String(),
            ]);
        }
    }
}
