<?php

namespace Botble\Language\Http\Controllers;

use Assets;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Base\Supports\Language;
use Botble\Language\LanguageManager;
use Botble\Language\Repositories\Interfaces\LanguageMetaInterface;
use Botble\Language\Http\Requests\LanguageRequest;
use Botble\Language\Repositories\Interfaces\LanguageInterface;
use Botble\Setting\Supports\SettingStore;
use Exception;
use Illuminate\Http\Request;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;

class LanguageController extends BaseController
{
    /**
     * @var LanguageInterface
     */
    protected $languageRepository;

    /**
     * @var LanguageMetaInterface
     */
    protected $languageMetaRepository;


    /**
     * LanguageController constructor.
     * @param LanguageInterface $languageRepository
     * @param LanguageMetaInterface $languageMetaRepository
     *
     */
    public function __construct(LanguageInterface $languageRepository, LanguageMetaInterface $languageMetaRepository)
    {
        $this->languageRepository = $languageRepository;
        $this->languageMetaRepository = $languageMetaRepository;
    }

    /**
     * Get list language page
     *
     */
    public function getList()
    {
        page_title()->setTitle(trans('plugins/language::language.name'));

        Assets::addScriptsDirectly(['vendor/core/plugins/language/js/language.js']);

        $languages = Language::getListLanguages();
        $flags = Language::getListLanguageFlags();
        $active_languages = $this->languageRepository->all();
        return view('plugins/language::index', compact('languages', 'flags', 'active_languages'));
    }

    /**
     * @param LanguageRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     * @throws \Throwable
     */
    public function postStore(LanguageRequest $request, BaseHttpResponse $response)
    {
        try {
            $language = $this->languageRepository->getFirstBy([
                'lang_code' => $request->input('lang_code'),
            ]);
            if ($language) {
                return $response
                    ->setError()
                    ->setMessage(__('This language is added already!'));
            }

            if ($this->languageRepository->count() == 0) {
                $request->merge(['lang_is_default' => 1]);
            }
            $language = $this->languageRepository->createOrUpdate($request->except('lang_id'));

            event(new CreatedContentEvent(LANGUAGE_MODULE_SCREEN_NAME, $request, $language));

            return $response
                ->setData(view('plugins/language::partials.language-item', ['item' => $language])->render())
                ->setMessage(trans('core/base::notices.create_success_message'));
        } catch (Exception $ex) {
            return $response
                ->setError()
                ->setMessage($ex->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     * @throws \Throwable
     */
    public function postEdit(Request $request, BaseHttpResponse $response)
    {
        try {
            $language = $this->languageRepository->getFirstBy(['lang_id' => $request->input('lang_id')]);
            if (empty($language)) {
                abort(404);
            }
            $language->fill($request->input());
            $language = $this->languageRepository->createOrUpdate($language);

            event(new UpdatedContentEvent(LANGUAGE_MODULE_SCREEN_NAME, $request, $language));

            return $response
                ->setData(view('plugins/language::partials.language-item', ['item' => $language])->render())
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (Exception $ex) {
            return $response
                ->setError()
                ->setMessage($ex->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     */
    public function postChangeItemLanguage(Request $request, BaseHttpResponse $response)
    {
        $content_id = $request->input('lang_meta_content_id') ? $request->input('lang_meta_content_id') : $request->input('lang_meta_created_from');
        $current_language = $this->languageMetaRepository->getFirstBy([
            'lang_meta_content_id' => $content_id,
            'lang_meta_reference'  => $request->input('lang_meta_reference'),
        ]);
        $others = $this->languageMetaRepository->getModel();
        if ($current_language) {
            $others = $others->where('lang_meta_code', '!=', $request->input('lang_meta_current_language'))
                ->where('lang_meta_origin', $current_language->origin);
        }
        $others = $others->select('lang_meta_content_id', 'lang_meta_code')
            ->get();
        $data = [];
        foreach ($others as $other) {
            $language = $this->languageRepository->getFirstBy(['lang_code' => $other->lang_code], [
                'lang_flag',
                'lang_name',
                'lang_code',
            ]);
            if (!empty($language) && !empty($current_language) && $language->lang_code != $current_language->lang_meta_code) {
                $data[$language->lang_code]['lang_flag'] = $language->lang_flag;
                $data[$language->lang_code]['lang_name'] = $language->lang_name;
                $data[$language->lang_code]['lang_meta_content_id'] = $other->lang_meta_content_id;
            }
        }

        $languages = $this->languageRepository->all();
        foreach ($languages as $language) {
            if (!array_key_exists($language->lang_code, $data) && $language->lang_code != $request->input('lang_meta_current_language')) {
                $data[$language->lang_code]['lang_flag'] = $language->lang_flag;
                $data[$language->lang_code]['lang_name'] = $language->lang_name;
                $data[$language->lang_code]['lang_meta_content_id'] = null;
            }
        }

        return $response->setData($data);
    }

    /**
     * @param Request $request
     * @param $id
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     */
    public function getDelete(Request $request, $id, BaseHttpResponse $response)
    {
        try {
            $language = $this->languageRepository->getFirstBy(['lang_id' => $id]);
            $this->languageRepository->delete($language);
            $delete_default = false;
            if ($language->lang_is_default) {
                $default = $this->languageRepository->getFirstBy([
                    'lang_is_default' => 0,
                ]);
                if ($default) {
                    $default->lang_is_default = 1;
                    $this->languageRepository->createOrUpdate($default);
                    $delete_default = $default->lang_id;
                }
            }

            event(new DeletedContentEvent(LANGUAGE_MODULE_SCREEN_NAME, $request, $language));

            return $response
                ->setData($delete_default)
                ->setMessage(trans('core/base::notices.delete_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setMessage($exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     */
    public function getSetDefault(Request $request, BaseHttpResponse $response)
    {
        $this->languageRepository->update(['lang_is_default' => 1], ['lang_is_default' => 0]);
        $language = $this->languageRepository->getFirstBy(['lang_id' => $request->input('lang_id')]);
        if ($language) {
            $language->lang_is_default = 1;
            $this->languageRepository->createOrUpdate($language);
        }

        event(new UpdatedContentEvent(LANGUAGE_MODULE_SCREEN_NAME, $request, $language));

        return $response->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     */
    public function getLanguage(Request $request, BaseHttpResponse $response)
    {
        $language = $this->languageRepository->getFirstBy(['lang_id' => $request->input('lang_id')]);
        return $response->setData($language);
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @param SettingStore $settingStore
     * @return BaseHttpResponse
     *
     */
    public function postEditSettings(Request $request, BaseHttpResponse $response, SettingStore $settingStore)
    {
        $settingStore
            ->set('language_hide_default', $request->input('language_hide_default', false))
            ->set('language_display', $request->input('language_display'))
            ->set('language_switcher_display', $request->input('language_switcher_display'))
            ->set('language_hide_languages', json_encode($request->input('language_hide_languages', [])))
            ->set('language_show_default_item_if_current_version_not_existed', $request->input('language_show_default_item_if_current_version_not_existed'))
            ->save();
        return $response->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param $code
     * @param \Botble\Language\LanguageManager $language
     * @return \Illuminate\Http\RedirectResponse
     *
     * @since 2.2
     */
    public function getChangeDataLanguage($code, LanguageManager $language)
    {
        $previousUrl = strtok(app('url')->previous(), '?');

        $query_string = null;
        if ($code !== $language->getDefaultLocaleCode()) {
            $query_string = '?' . http_build_query(['ref_lang' => $code]);
        }

        return redirect()->to($previousUrl . $query_string);
    }
}
