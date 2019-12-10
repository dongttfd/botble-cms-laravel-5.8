<?php

namespace Botble\Base\Providers;

use Form;
use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{

    /**
     * Boot the service provider.
     * @return void
     *
     */
    public function boot()
    {
        Form::component('mediaImage', 'core/base::elements.forms.image', [
            'name',
            'value'      => null,
            'attributes' => [],
        ]);

        Form::component('modalAction', 'core/base::elements.forms.modal', [
            'name',
            'title',
            'type'        => null,
            'content'     => null,
            'action_id'   => null,
            'action_name' => null,
            'modal_size'  => null,
        ]);

        Form::component('helper', 'core/base::elements.forms.helper', ['content']);

        Form::component('onOff', 'core/base::elements.forms.on-off', [
            'name',
            'value'      => false,
            'attributes' => [],
        ]);

        /**
         * Custom checkbox
         * Every checkbox will not have the same name
         */
        Form::component('customCheckbox', 'core/base::elements.custom-checkbox', [
            /**
             * @var array $values
             * @template: [
             *      [string $name, string $value, string $label, bool $selected, bool $disabled],
             *      [string $name, string $value, string $label, bool $selected, bool $disabled],
             *      [string $name, string $value, string $label, bool $selected, bool $disabled],
             * ]
             */
            'values',
        ]);

        /**
         * Custom radio
         * Every radio in list must have the same name
         */
        Form::component('customRadio', 'core/base::elements.custom-radio', [
            /**
             * @var string $name
             */
            'name',
            /**
             * @var array $values
             * @template: [
             *      [string $value, string $label, bool $disabled],
             *      [string $value, string $label, bool $disabled],
             *      [string $value, string $label, bool $disabled],
             * ]
             */
            'values',
            /**
             * @var string|null $selected
             */
            'selected' => null,
        ]);

        Form::component('error', 'core/base::elements.forms.error', [
            'name',
            'errors' => null,
        ]);

        Form::component('editor', 'core/base::elements.forms.editor-input', [
            'name',
            'value'      => null,
            'attributes' => [],
        ]);

        Form::component('customSelect', 'core/base::elements.forms.custom-select', [
            'name',
            'list'                => [],
            'selected'            => null,
            'selectAttributes'    => [],
            'optionsAttributes'   => [],
            'optgroupsAttributes' => [],
        ]);

        Form::component('googleFonts', 'core/base::elements.forms.google-fonts', [
            'name',
            'selected'          => null,
            'selectAttributes'  => [],
            'optionsAttributes' => [],
        ]);
    }
}
