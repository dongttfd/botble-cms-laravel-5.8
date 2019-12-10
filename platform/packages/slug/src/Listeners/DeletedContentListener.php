<?php

namespace Botble\Slug\Listeners;

use Botble\Base\Events\DeletedContentEvent;
use Botble\Slug\Repositories\Interfaces\SlugInterface;
use Exception;

class DeletedContentListener
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
     * @param DeletedContentEvent $event
     * @return void
     *
     */
    public function handle(DeletedContentEvent $event)
    {
        if (in_array($event->screen, config('packages.slug.general.supported'))) {
            try {
                $this->slugRepository->deleteBy(['reference_id' => $event->data->id, 'reference' => $event->screen]);
            } catch (Exception $exception) {
                info($exception->getMessage());
            }
        }
    }
}
