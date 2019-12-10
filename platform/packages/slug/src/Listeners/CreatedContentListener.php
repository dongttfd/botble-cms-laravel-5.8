<?php

namespace Botble\Slug\Listeners;

use Botble\Base\Events\CreatedContentEvent;
use Botble\Slug\Repositories\Interfaces\SlugInterface;
use Botble\Slug\Services\SlugService;
use Exception;

class CreatedContentListener
{

    /**
     * @var SlugInterface
     */
    protected $slugRepository;

    /**
     * SlugService constructor.
     * @param SlugInterface $slugRepository
     */
    public function __construct(SlugInterface $slugRepository)
    {
        $this->slugRepository = $slugRepository;
    }

    /**
     * Handle the event.
     *
     * @param CreatedContentEvent $event
     * @param SlugService $slugService
     * @return void
     *
     */
    public function handle(CreatedContentEvent $event)
    {
        if (in_array($event->screen, config('packages.slug.general.supported'))) {
            try {
                $slug = $event->request->input('slug', $event->data->name . '-' . $event->data->id ?? time());
                $slugService = new SlugService(app(SlugInterface::class));

                $this->slugRepository->createOrUpdate([
                    'key'          => $slugService->create($slug, $event->data->slug_id, $event->screen),
                    'reference'    => $event->screen,
                    'reference_id' => $event->data->id,
                    'prefix'       => config('packages.slug.general.prefixes.' . $event->screen, ''),
                ]);
            } catch (Exception $exception) {
                info($exception->getMessage());
            }
        }
    }
}
