<?php

namespace Botble\Base\Events;

use Botble\Slug\Models\Slug;
use Illuminate\Queue\SerializesModels;

class RenderingSingleEvent extends Event
{
    use SerializesModels;

    /**
     * @var Slug
     */
    public $slug;

    /**
     * RenderingSingleEvent constructor.
     * @param Slug $slug
     */
    public function __construct(Slug $slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     *
     */
    public function broadcastOn()
    {
        return [];
    }
}
