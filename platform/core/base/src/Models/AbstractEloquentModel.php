<?php

namespace Botble\Base\Models;

use Eloquent;

abstract class AbstractEloquentModel extends Eloquent
{
    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @return EloquentBuilder|Eloquent|\Illuminate\Database\Eloquent\Builder
     */
    public function newEloquentBuilder($query)
    {
        return new EloquentBuilder($query);
    }
}
