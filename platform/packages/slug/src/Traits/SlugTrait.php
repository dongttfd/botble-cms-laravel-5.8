<?php

namespace Botble\Slug\Traits;

use Botble\Slug\Repositories\Interfaces\SlugInterface;

trait SlugTrait
{
    /**
     * @var string
     */
    protected $slug = '';

    /**
     * @var int
     */
    protected $slugId = 0;

    /**
     * @return mixed
     *
     */
    public function getScreen()
    {
        return $this->screen;
    }

    /**
     * @return string
     *
     */
    public function getSlugAttribute()
    {
        if ($this->key != null) {
            return $this->key;
        }

        if ($this->slug != null) {
            return $this->slug;
        }

        $slug = app(SlugInterface::class)->getFirstBy([
            'reference'    => $this->screen,
            'reference_id' => $this->getKey(),
        ], ['slugs.id', 'slugs.key']);

        if ($slug) {
            $this->slugId = $slug->id;
            $this->slug = $slug->key;
        }

        return $this->slug;
    }

    /**
     * @param $value
     * @return int
     *
     */
    public function getSlugIdAttribute()
    {
        if ($this->slugId != 0) {
            return $this->slugId;
        }

        $slug = app(SlugInterface::class)->getFirstBy([
            'reference'    => $this->screen,
            'reference_id' => $this->getKey(),
        ], ['slugs.id', 'slugs.key']);

        if ($slug) {
            $this->slug = $slug->key;
            $this->slugId = $slug->id;
        }

        return $this->slugId;
    }
}
