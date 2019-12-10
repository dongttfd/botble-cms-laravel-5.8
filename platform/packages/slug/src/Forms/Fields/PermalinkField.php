<?php

namespace Botble\Slug\Forms\Fields;

use Assets;
use Kris\LaravelFormBuilder\Fields\FormField;

class PermalinkField extends FormField
{

    /**
     * @return string
     *
     */
    protected function getTemplate()
    {
        Assets::addScriptsDirectly('vendor/core/packages/slug/js/slug.js');

        return 'packages/slug::forms.fields.permalink';
    }
}