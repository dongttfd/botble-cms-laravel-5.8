<?php

namespace Botble\Blog\Forms;

use Assets;
use Botble\Member\Forms\Fields\CustomEditorField;
use Botble\Member\Forms\Fields\CustomImageField;
use Botble\Blog\Http\Requests\MemberPostRequest;

class MemberPostForm extends PostForm
{

    /**
     * @return mixed|void
     * @throws \Throwable
     */
    public function buildForm()
    {
        parent::buildForm();

        Assets::addScriptsDirectly('vendor/core/libraries/tinymce/tinymce.min.js')
            ->addScripts(['bootstrap-tagsinput', 'typeahead'])
            ->addStyles(['bootstrap-tagsinput'])
            ->addScriptsDirectly('vendor/core/js/tags.js');

        if (!$this->formHelper->hasCustomField('customEditor')) {
            $this->formHelper->addCustomField('customEditor', CustomEditorField::class);
        }

        if (!$this->formHelper->hasCustomField('customImage')) {
            $this->formHelper->addCustomField('customImage', CustomImageField::class);
        }

        $this->setModuleName(MEMBER_POST_MODULE_SCREEN_NAME)
            ->setFormOption('template', 'plugins/member::forms.base')
            ->setFormOption('enctype', 'multipart/form-data')
            ->setValidatorClass(MemberPostRequest::class)
            ->setActionButtons(view('plugins/member::forms.actions')->render())
            ->remove('status')
            ->remove('is_featured')
            ->remove('content')
            ->remove('image')
            ->addAfter('description', 'content', 'customEditor', [
                'label'      => trans('core/base::forms.content'),
                'label_attr' => ['class' => 'control-label'],
            ])
            ->addBefore('tag', 'image', 'customImage', [
                'label'      => trans('core/base::forms.image'),
                'label_attr' => ['class' => 'control-label'],
            ])
            ->setBreakFieldPoint('format_type');
    }
}