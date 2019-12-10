<?php

namespace Botble\Base\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\SelectType;

class CustomSelectField extends SelectType
{

    /**
     * Get the template, can be config variable or view path.
     *
     * @return string
     */
    protected function getTemplate()
    {
        return 'core/base::forms.fields.custom-select';
    }
}