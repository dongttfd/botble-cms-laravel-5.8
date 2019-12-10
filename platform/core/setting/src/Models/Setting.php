<?php

namespace Botble\Setting\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 * @package Botble\Setting\Models
 * @mixin \Eloquent
 */
class Setting extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;
}
