<?php

namespace Botble\Base\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MetaBox
 * @package Botble\Base\Models
 * @mixin \Eloquent
 */
class MetaBox extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'meta_boxes';

    /**
     * @param $value
     * 
     */
    public function setMetaValueAttribute($value)
    {
        $this->attributes['meta_value'] = json_encode($value);
    }

    /**
     * @param $value
     * @return mixed
     * 
     */
    public function getMetaValueAttribute($value)
    {
        return json_decode($value, true);
    }
}
