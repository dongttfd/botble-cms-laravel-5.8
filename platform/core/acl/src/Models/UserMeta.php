<?php

namespace Botble\ACL\Models;

use Auth;
use Eloquent;

/**
 * Class UserMeta
 * @package Botble\ACL\Models
 * @mixin Eloquent
 */
class UserMeta extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_meta';

    /**
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
        'user_id',
    ];

    /**
     * The date fields for the model.clear
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @param string $key
     * @param null $value
     * @param int $user_id
     * @return bool
     * 
     */
    public static function setMeta($key, $value = null, $user_id = 0)
    {
        if ($user_id == 0) {
            $user_id = Auth::user()->getKey();
        }

        $meta = self::firstOrCreate([
            'user_id' => $user_id,
            'key'     => $key,
        ]);

        return $meta->update(['value' => $value]);
    }

    /**
     * @param string $key
     * @param null $default_value
     * @param int $user_id
     * @return string
     * 
     */
    public static function getMeta($key, $default_value = null, $user_id = 0)
    {
        if ($user_id == 0) {
            $user_id = Auth::user()->getKey();
        }

        $meta = self::where([
            'user_id' => $user_id,
            'key'     => $key,
        ])->select('value')->first();

        if (!empty($meta)) {
            return $meta->value;
        }

        return $default_value;
    }
}
