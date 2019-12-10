<?php

namespace Botble\ACL\Forms;

use Botble\ACL\Http\Requests\UpdatePasswordRequest;
use Botble\Base\Forms\FormAbstract;
use Html;

class PasswordForm extends FormAbstract
{

    /**
     * @return mixed|void
     * @throws \Throwable
     */
    public function buildForm()
    {
        $this
            ->setModuleName(USER_MODULE_SCREEN_NAME)
            ->setValidatorClass(UpdatePasswordRequest::class)
            ->setFormOption('template', 'core/base::forms.form-no-wrap')
            ->setFormOption('id', 'password-form')
            ->add('old_password', 'password', [
                'label'      => trans('core/acl::users.current_password'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'data-counter' => 60,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('password', 'password', [
                'label'      => trans('core/acl::users.new_password'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'data-counter' => 60,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
                'help_block' => [
                    'text' => Html::tag('span', 'Password Strength', ['class' => 'hidden'])->toHtml(),
                    'tag'  => 'div',
                    'attr' => [
                        'class' => 'pwstrength_viewport_progress',
                    ],
                ],
            ])
            ->add('password_confirmation', 'password', [
                'label'      => trans('core/acl::users.confirm_new_password'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'data-counter' => 60,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->setActionButtons(view('core/acl::users.profile.actions')->render());
    }
}