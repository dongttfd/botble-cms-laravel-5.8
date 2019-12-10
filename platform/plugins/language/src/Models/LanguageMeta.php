<?php

namespace Botble\Language\Models;

use Eloquent;

/**
 * Botble\Language\Models\LanguageMeta
 *
 * @mixin \Eloquent
 */
class LanguageMeta extends Eloquent
{

    /**
     * @var string
     */
    protected $primaryKey = 'lang_meta_id';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'language_meta';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'lang_meta_content_id',
        'lang_meta_code',
        'lang_meta_reference',
        'lang_meta_origin',
    ];
}
