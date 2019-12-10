<?php

namespace Botble\Base\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class MediaImageField extends FormField
{

    /**
     * @return string
     */
    protected function getTemplate()
    {
        return 'core/base::forms.fields.media-image';
    }
}