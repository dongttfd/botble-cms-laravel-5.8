<?php

use Botble\Block\Repositories\Interfaces\BlockInterface;

if (!function_exists('get_list_blocks')) {
    /**
     * @param array $condition
     * @return mixed
     *
     */
    function get_list_blocks(array $condition)
    {
        return app(BlockInterface::class)->allBy($condition);
    }
}
