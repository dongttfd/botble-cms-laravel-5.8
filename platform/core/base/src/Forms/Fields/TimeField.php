<?php

namespace Botble\Base\Forms\Fields;

use Assets;
use Kris\LaravelFormBuilder\Fields\FormField;

class TimeField extends FormField
{

    /**
     * Get the template, can be config variable or view path.
     *
     * @return string
     */
    protected function getTemplate()
    {
        Assets::addScripts(['timepicker'])
            ->addStyles(['timepicker']);

        return 'core/base::forms.fields.time';
    }
}