<?php

namespace Botble\Page\Listeners;

use Botble\Page\Repositories\Interfaces\PageInterface;
use JsonFeedManager;

class RenderingJsonFeedListener
{
    /**
     * @var PageInterface
     */
    protected $pageRepository;

    /**
     * RenderingSiteMapListener constructor.
     * @param PageInterface $pageRepository
     */
    public function __construct(PageInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * Handle the event.
     *
     * @return void
     *
     */
    public function handle()
    {
        $pages = $this->pageRepository->getAllPages(true);

        foreach ($pages as $page) {
            JsonFeedManager::addItem('pages', [
                'id'             => $page->id,
                'title'          => $page->name,
                'url'            => route('public.single', $page->slug),
                'image'          => $page->image,
                'content_html'   => $page->content,
                'date_published' => $page->created_at->tz('UTC')->toRfc3339String(),
                'date_modified'  => $page->updated_at->tz('UTC')->toRfc3339String(),
            ]);
        }
    }
}
