<?php

namespace Botble\Contact\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Contact\Enums\ContactStatusEnum;
use Eloquent;

class Contact extends Eloquent
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contacts';

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
        'name',
        'email',
        'phone',
        'address',
        'subject',
        'content',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => ContactStatusEnum::class,
    ];

    /**
     * @return mixed
     */
    public function replies()
    {
        return $this->hasMany(ContactReply::class);
    }
}
