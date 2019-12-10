<?php

namespace Botble\CustomField\Models;

use Botble\CustomField\Repositories\Interfaces\CustomFieldInterface;
use Eloquent;

class FieldItem extends Eloquent
{
    /**
     * @var string
     */
    protected $table = 'field_items';

    /**
     * @var array
     */
    protected $fillable = [
        'field_group_id',
        'parent_id',
        'order',
        'title',
        'slug',
        'type',
        'instructions',
        'options',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fieldGroup()
    {
        return $this->belongsTo(FieldGroup::class, 'field_group_id')->withDefault();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(FieldItem::class, 'parent_id')->withDefault();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function child()
    {
        return $this->hasMany(FieldItem::class, 'parent_id');
    }

    protected static function boot()
    {
        parent::boot();

        self::deleting(function (FieldItem $fieldItem) {
            app(CustomFieldInterface::class)->deleteBy(['field_item_id' => $fieldItem->id]);
        });
    }
}
