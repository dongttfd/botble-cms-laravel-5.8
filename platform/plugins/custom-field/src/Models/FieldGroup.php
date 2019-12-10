<?php

namespace Botble\CustomField\Models;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Traits\EnumCastable;
use Botble\CustomField\Repositories\Interfaces\FieldItemInterface;
use Eloquent;

class FieldGroup extends Eloquent
{
    use EnumCastable;

    /**
     * @var string
     */
    protected $table = 'field_groups';

    /**
     * @var array
     */
    protected $fillable = [
        'order',
        'rules',
        'title',
        'status',
        'created_by',
        'updated_by',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fieldItems()
    {
        return $this->hasMany(FieldItem::class, 'field_group_id');
    }

    protected static function boot()
    {
        parent::boot();

        self::deleting(function (FieldGroup $fieldGroup) {
            app(FieldItemInterface::class)->deleteBy(['field_group_id' => $fieldGroup->id]);
        });
    }
}
