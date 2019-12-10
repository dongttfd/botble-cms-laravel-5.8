<?php

use Botble\Slug\Repositories\Interfaces\SlugInterface;

if (!function_exists('get_slug_key_item')) {
    /**
     * @param $screen
     * @param $reference_id
     * @return null
     *
     */
    function get_slug_key_item($screen, $reference_id)
    {
        $slug = app(SlugInterface::class)->getFirstBy([
            'reference'    => $screen,
            'reference_id' => $reference_id,
        ]);

        if ($slug) {
            return $slug->key;
        }

        return null;
    }
}
