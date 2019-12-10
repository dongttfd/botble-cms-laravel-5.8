<?php

namespace Botble\RequestLog\Models;

use Eloquent;

class RequestLog extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'request_logs';

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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'status_code',
    ];

    /**
     * @param $value
     */
    public function setReferrerAttribute($value)
    {
        $this->attributes['referrer'] = json_encode($value);
    }

    /**
     * @param $value
     * @return array
     */
    public function getReferrerAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * @param $value
     */
    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = json_encode($value);
    }

    /**
     * @param $value
     * @return array
     */
    public function getUserIdAttribute($value)
    {
        return json_decode($value, true);
    }
}
