<?php

namespace Botble\ACL\Forms;

use Botble\ACL\Http\Requests\CreateUserRequest;
use Botble\ACL\Repositories\Interfaces\RoleInterface;
use Botble\Base\Forms\FormAbstract;

class UserForm extends FormAbstract
{
    /**
     * @var RoleInterface
     */
    protected $roleRepository;

    /**
     * UserForm constructor.
     * @param RoleInterface $roleRepository
     * @throws \Throwable
     */
    public function __construct(RoleInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
        parent::__construct();
    }

    /**
     * @return mixed|void
     * @throws \Throwable
     */
    public function buildForm()
    {
        $roles = $this->roleRepository->pluck('name', 'id');

        $this
            ->setModuleName(USER_MODULE_SCREEN_NAME)
            ->setValidatorClass(CreateUserRequest::class)
            ->setWrapperClass('form-body row')
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
            ->add('password', 'password', [
                'label'      => trans('core/acl::users.password'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'data-counter' => 60,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('password_confirmation', 'password', [
                'label'      => __('Re-type password'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'data-counter' => 60,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('role_id', 'customSelect', [
                'label'      => trans('core/acl::users.role'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'class' => 'form-control roles-list',
                ],
                'choices'    => ['' => __('Select role')] + $roles,
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-12',
                ],
            ]);
    }
}