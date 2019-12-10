<?php

namespace Botble\Blog\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class CategoryMultiField extends FormField
{

    /**
     * @return string
     *
     */
    protected function getTemplate()
    {
        return 'plugins/blog::categories.partials.categories-multi';
    }
}