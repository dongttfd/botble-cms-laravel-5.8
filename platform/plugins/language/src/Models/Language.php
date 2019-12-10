<?php

namespace Botble\Language\Models;

use Eloquent;

/**
 * Botble\Language\Models\Language
 *
 * @mixin \Eloquent
 */
class Language extends Eloquent
{

    /**
     * @var string
     */
    protected $primaryKey = 'lang_id';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'languages';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'lang_name',
        'lang_locale',
        'lang_is_default',
        'lang_code',
        'lang_is_rtl',
        'lang_flag',
        'lang_order',
    ];

    protected static function boot()
    {
        parent::boot();

        self::deleted(function (Language $language) {
            $default_language = self::where('lang_is_default', 1)->first();
            if (empty($default_language) && self::count() == 0) {
                LanguageMeta::truncate();
            } else {
                if (empty($default_language)) {
                    $default_language = self::first();
                    $default_language->lang_is_default = 1;
                    $default_language->save();
                }

                if (!empty($default_language)) {
                    LanguageMeta::where('lang_meta_code', $language->lang_code)->update(['lang_meta_code' => $default_language->lang_code]);
                }
            }
        });
    }
}
