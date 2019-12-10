<?php

namespace Botble\Setting\Http\Controllers;

use Assets;
use Botble\Base\Supports\EmailHandler;
use Botble\Setting\Http\Requests\EmailTemplateRequest;
use Botble\Setting\Http\Requests\MediaSettingRequest;
use Botble\Setting\Http\Requests\SendTestEmailRequest;
use Botble\Setting\Repositories\Interfaces\SettingInterface;
use Botble\Setting\Supports\SettingStore;
use Exception;
use Illuminate\Support\Facades\File;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    /**
     * @var SettingInterface
     */
    protected $settingRepository;

    /**
     * SettingController constructor.
     * @param SettingInterface $settingRepository
     */
    public function __construct(SettingInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function getOptions()
    {
        page_title()->setTitle(trans('core/setting::setting.title'));

        return view('core/setting::index');
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @param SettingStore $setting
     * @return BaseHttpResponse
     */
    public function postEdit(Request $request, BaseHttpResponse $response, SettingStore $setting)
    {
        foreach ($request->except(['_token']) as $key => $value) {
            $setting->set($key, $value);
        }

        $setting->save();

        return $response
            ->setPreviousUrl(route('settings.options'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEmailConfig()
    {
        page_title()->setTitle(trans('core/base::layouts.setting_email'));
        Assets::addScriptsDirectly('vendor/core/js/setting.js');

        return view('core/setting::email');
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @param SettingStore $setting
     * @return BaseHttpResponse
     */
    public function postEditEmailConfig(Request $request, BaseHttpResponse $response, SettingStore $setting)
    {
        foreach ($request->except(['_token']) as $key => $value) {
            $setting->set($key, $value);
        }

        $setting->save();

        return $response
            ->setPreviousUrl(route('settings.email'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param $type
     * @param $name
     * @param $template_file
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getEditEmailTemplate($type, $name, $template_file)
    {
        page_title()->setTitle(trans(config($type . '.' . $name . '.email.templates.' . $template_file . '.title', '')));

        Assets::addStylesDirectly([
                'vendor/core/libraries/codemirror/lib/codemirror.css',
                'vendor/core/libraries/codemirror/addon/hint/show-hint.css',
                'vendor/core/css/setting.css',
            ])
            ->addScriptsDirectly([
                'vendor/core/libraries/codemirror/lib/codemirror.js',
                'vendor/core/libraries/codemirror/lib/css.js',
                'vendor/core/libraries/codemirror/addon/hint/show-hint.js',
                'vendor/core/libraries/codemirror/addon/hint/anyword-hint.js',
                'vendor/core/libraries/codemirror/addon/hint/css-hint.js',
                'vendor/core/js/setting.js',
            ]);


        $email_content = get_setting_email_template_content($type, $name, $template_file);
        $email_subject = get_setting_email_subject($type, $name, $template_file);
        $plugin_data = [
            'type'          => $type,
            'name'          => $name,
            'template_file' => $template_file,
        ];

        return view('core/setting::email-template-edit', compact('email_subject', 'email_content', 'plugin_data'));
    }

    /**
     * @param EmailTemplateRequest $request
     * @param BaseHttpResponse $response
     * @param SettingStore $setting
     * @return BaseHttpResponse
     */
    public function postStoreEmailTemplate(EmailTemplateRequest $request, BaseHttpResponse $response, SettingStore $setting)
    {
        if ($request->has('email_subject_key')) {
            $setting->set($request->input('email_subject_key'), $request->input('email_subject'));
            $setting->save();
        }

        save_file_data($request->input('template_path'), $request->input('email_content'), false);

        return $response->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function postResetToDefault(Request $request, BaseHttpResponse $response)
    {
        $this->settingRepository->deleteBy(['key' => $request->input('email_subject_key')]);
        File::delete($request->input('template_path'));

        return $response->setMessage(trans('core/setting::setting.email.reset_success'));
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @param SettingStore $setting
     * @return BaseHttpResponse
     */
    public function postChangeEmailStatus(Request $request, BaseHttpResponse $response, SettingStore $setting)
    {
        $setting
            ->set($request->input('key'), $request->input('value'))
            ->save();

        return $response->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param BaseHttpResponse $response
     * @param SendTestEmailRequest $request
     * @param EmailHandler $emailHandler
     * @return BaseHttpResponse
     * @throws \Throwable
     */
    public function postSendTestEmail(
        BaseHttpResponse $response,
        SendTestEmailRequest $request,
        EmailHandler $emailHandler
    )
    {
        try {
            $emailHandler->send(
                file_get_contents(core_path('setting/resources/email-templates/test.tpl')),
                __('Test title'),
                $request->input('email'),
                [],
                true
            );

            return $response->setMessage(__('Send email successfully!'));
        } catch (Exception $exception) {
            return $response->setError()
                ->setMessage($exception->getMessage());
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getMediaSetting()
    {
        page_title()->setTitle(trans('core/setting::setting.media.title'));

        return view('core/setting::media');
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @param SettingStore $setting
     * @return BaseHttpResponse
     */
    public function postEditMediaSetting(
        MediaSettingRequest $request,
        BaseHttpResponse $response,
        SettingStore $setting
    )
    {
        foreach ($request->except(['_token']) as $setting_key => $setting_value) {
            $setting->set($setting_key, $setting_value);
        }

        $setting->save();

        return $response
            ->setPreviousUrl(route('settings.media'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }
}
