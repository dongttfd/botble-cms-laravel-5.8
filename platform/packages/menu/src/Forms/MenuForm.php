<?php

namespace Botble\Menu\Forms;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Forms\FormAbstract;
use Botble\Menu\Http\Requests\MenuRequest;

class MenuForm extends FormAbstract
{

    /**
     * @return mixed|void
     * @throws \Throwable
     */
    public function buildForm()
    {
        $locations = [];

        if ($this->getModel()) {
            $locations = $this->getModel()->locations()->pluck('location')->all();
        }

        $this
            ->setModuleName(MENU_MODULE_SCREEN_NAME)
            ->setFormOption('class', 'form-save-menu')
            ->withCustomFields()
            ->setValidatorClass(MenuRequest::class)
            ->add('name', 'text', [
                'label'      => trans('core/base::forms.name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 120,
                ],
            ])
            ->add('status', 'customSelect', [
                'label'      => trans('core/base::tables.status'),
                'label_attr' => ['class' => 'control-label required'],
                'choices'    => BaseStatusEnum::labels(),
            ])
            ->addMetaBoxes([
                'structure' => [
                    'wrap'    => false,
                    'content' => view('packages/menu::menu-structure', [
                        'menu'      => $this->getModel(),
                        'locations' => $locations,
                    ])->render(),
                ],
            ])
            ->setBreakFieldPoint('status');
    }
}