<?php

namespace Botble\Base\Forms\Fields;

use Assets;
use Kris\LaravelFormBuilder\Fields\FormField;

class ColorField extends FormField
{

    /**
     * Get the template, can be config variable or view path.
     *
     * @return string
     */
    protected function getTemplate()
    {
        Assets::addScripts(['colorpicker'])
            ->addStyles(['colorpicker']);

        return 'core/base::forms.fields.color';
    }
}