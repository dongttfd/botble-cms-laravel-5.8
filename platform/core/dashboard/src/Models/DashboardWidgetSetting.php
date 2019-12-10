<?php

namespace Botble\Dashboard\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Eloquent
 * @mixin \Illuminate\Database\Eloquent\Concerns\HasRelationships
 */
class DashboardWidgetSetting extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'dashboard_widget_settings';

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
     * @var array
     */
    protected $fillable = [
        'settings',
        'widget_id',
        'user_id',
        'order',
        'status',
    ];

    /**
     * @param $value
     *
     */
    public function setSettingsAttribute($value)
    {
        $this->attributes['settings'] = json_encode($value);
    }

    /**
     * @param $value
     * @return mixed
     *
     */
    public function getSettingsAttribute($value)
    {
        try {
            if (empty($value)) {
                return [];
            }

            return json_decode($value, true);
        } catch (Exception $ex) {
            return [];
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     */
    public function widget()
    {
        return $this->belongsTo(DashboardWidget::class);
    }
}
