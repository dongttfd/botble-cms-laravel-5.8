<?php

namespace Botble\Base\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Migration
 * @package Botble\Base\Models
 * @mixin \Eloquent
 */
class Migration extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'migrations';
}
