<?php

namespace Botble\ACL\Forms;

use Botble\ACL\Http\Requests\UpdateProfileRequest;
use Botble\Base\Forms\FormAbstract;

class ProfileForm extends FormAbstract
{
    /**
     * @return mixed|void
     * @throws \Throwable
     */
    public function buildForm()
    {
        $this
            ->setModuleName(USER_MODULE_SCREEN_NAME)
            ->setFormOption('template', 'core/base::forms.form-no-wrap')
            ->setFormOption('id', 'profile-form')
            ->setFormOption('class', 'row')
            ->setValidatorClass(UpdateProfileRequest::class)
            ->withCustomFields()
            ->add('first_name', 'text', [
                'label'      => trans('core/acl::users.info.first_name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'data-counter' => 30,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('last_name', 'text', [
                'label'      => trans('core/acl::users.info.last_name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'data-counter' => 30,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('username', 'text', [
                'label'      => trans('core/acl::users.username'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'data-counter' => 30,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('email', 'text', [
                'label'      => trans('core/acl::users.email'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Ex: example@gmail.com'),
                    'data-counter' => 60,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('secondary_email', 'text', [
                'label'      => trans('core/acl::users.info.second_email'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => __('Ex: example@gmail.com'),
                    'data-counter' => 60,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('address', 'text', [
                'label'      => trans('core/acl::users.info.address'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => __('Ex: 12 Le Duc Tho, Ho Chi Minh City'),
                    'data-counter' => 120,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('secondary_address', 'text', [
                'label'      => trans('core/acl::users.info.second_address'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => __('Ex: 12 Le Duc Tho, Ho Chi Minh City'),
                    'data-counter' => 120,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('dob', 'text', [
                'label'      => trans('core/acl::users.info.birth_day'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'data-counter'     => 30,
                    'class'            => 'form-control datepicker',
                    'data-date-format' => config('core.base.general.date_format.js.date'),
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('job_position', 'text', [
                'label'      => trans('core/acl::users.info.job'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'data-counter' => 120,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('phone', 'text', [
                'label'      => trans('core/acl::users.info.mobile_number'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'data-counter' => 15,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('secondary_phone', 'text', [
                'label'      => trans('core/acl::users.info.second_mobile_number'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'data-counter' => 15,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('gender', 'customSelect', [
                'label'      => trans('core/acl::users.gender.title'),
                'label_attr' => ['class' => 'control-label'],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
                'choices'    => [
                    1 => trans('core/acl::users.gender.male'),
                    0 => trans('core/acl::users.gender.female'),
                ],
            ])
            ->add('interest', 'textarea', [
                'label'      => trans('core/acl::users.info.interes'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'data-counter' => 255,
                    'placeholder'  => 'Design, Web etc.',
                    'rows'         => 4,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('about', 'textarea', [
                'label'      => trans('core/acl::users.info.about'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'data-counter' => 400,
                    'placeholder'  => 'Something about you.',
                    'rows'         => 4,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('skype', 'text', [
                'label'      => 'Skype',
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'data-counter' => 60,
                    'placeholder'  => 'Ex: john.smith',
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('facebook', 'text', [
                'label'      => 'Facebook',
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'data-counter' => 120,
                    'placeholder'  => 'https://facebook.com',
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('twitter', 'text', [
                'label'      => 'Twitter',
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'data-counter' => 120,
                    'placeholder'  => 'https://www.twitter.com',
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('google_plus', 'text', [
                'label'      => 'Google Plus',
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'data-counter' => 120,
                    'placeholder'  => 'https://plus.google.com',
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('youtube', 'text', [
                'label'      => 'Youtube',
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'data-counter' => 120,
                    'placeholder'  => 'https://youtube.com',
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('github', 'text', [
                'label'      => 'Github',
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'data-counter' => 120,
                    'placeholder'  => 'https://github.com',
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('website', 'text', [
                'label'      => 'Website',
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'data-counter' => 120,
                    'placeholder'  => 'https://your-site.com',
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->setActionButtons(view('core/acl::users.profile.actions')->render());
    }
}