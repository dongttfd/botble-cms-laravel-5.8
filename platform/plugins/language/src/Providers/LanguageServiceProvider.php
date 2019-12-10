<?php

namespace Botble\Language\Providers;

use Assets;
use Auth;
use Illuminate\Routing\Events\RouteMatched;
use Botble\Base\Supports\Helper;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Language\Facades\LanguageFacade;
use Botble\Language\Http\Middleware\LocaleSessionRedirect;
use Botble\Language\Http\Middleware\LocalizationRedirectFilter;
use Botble\Language\Http\Middleware\LocalizationRoutes;
use Botble\Language\Models\Language as LanguageModel;
use Botble\Language\Models\LanguageMeta;
use Botble\Language\Repositories\Caches\LanguageMetaCacheDecorator;
use Botble\Language\Repositories\Eloquent\LanguageMetaRepository;
use Botble\Language\Repositories\Interfaces\LanguageMetaInterface;
use Event;
use Html;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Botble\Language\Repositories\Caches\LanguageCacheDecorator;
use Botble\Language\Repositories\Eloquent\LanguageRepository;
use Botble\Language\Repositories\Interfaces\LanguageInterface;
use Language;
use Route;
use Theme;
use Yajra\DataTables\DataTableAbstract;

class LanguageServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    public function register()
    {
        $this->setNamespace('plugins/language')
            ->loadAndPublishConfigurations(['general']);

        $this->app->bind(LanguageInterface::class, function () {
            return new LanguageCacheDecorator(new LanguageRepository(new LanguageModel));
        });

        $this->app->bind(LanguageMetaInterface::class, function () {
            return new LanguageMetaCacheDecorator(new LanguageMetaRepository(new LanguageMeta));
        });

        Helper::autoload(__DIR__ . '/../../helpers');

        AliasLoader::getInstance()->alias('Language', LanguageFacade::class);

        /**
         * @var Router $router
         */
        $router = $this->app['router'];
        $router->aliasMiddleware('localize', LocalizationRoutes::class);
        $router->aliasMiddleware('localizationRedirect', LocalizationRedirectFilter::class);
        $router->aliasMiddleware('localeSessionRedirect', LocaleSessionRedirect::class);
    }

    public function boot()
    {
        $this->setNamespace('plugins/language')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadMigrations()
            ->publishAssetsFolder()
            ->publishPublicFolder();

        if ($this->app->runningInConsole()) {
            $this->app->register(CommandServiceProvider::class);
        } else {
            $this->app->register(EventServiceProvider::class);

            Event::listen(RouteMatched::class, function () {
                dashboard_menu()->registerItem([
                    'id'          => 'cms-plugins-language',
                    'priority'    => 2,
                    'parent_id'   => 'cms-core-settings',
                    'name'        => 'plugins/language::language.menu',
                    'icon'        => null,
                    'url'         => route('languages.list'),
                    'permissions' => ['languages.list'],
                ]);

                Assets::addScriptsDirectly('vendor/core/plugins/language/js/language-global.js')
                    ->addStylesDirectly(['vendor/core/plugins/language/css/language.css']);
            });

            $default_language = Language::getDefaultLanguage(['lang_id']);
            if (!empty($default_language)) {
                add_action(BASE_ACTION_META_BOXES, [$this, 'addLanguageBox'], 50, 3);
                add_action(BASE_ACTION_TOP_FORM_CONTENT_NOTIFICATION, [$this, 'addCurrentLanguageEditingAlert'], 55, 3);
                add_action(BASE_ACTION_BEFORE_EDIT_CONTENT, [$this, 'getCurrentAdminLanguage'], 55, 3);
                if (defined('THEME_OPTIONS_MODULE_SCREEN_NAME')) {
                    $this->app->booted(function () {
                        Theme::asset()->add('language-css', 'vendor/core/plugins/language/css/language-public.css');
                        Theme::asset()->container('footer')->add('language-public-js',
                            'vendor/core/plugins/language/js/language-public.js', ['jquery']);
                    });
                }

                add_filter(BASE_FILTER_GET_LIST_DATA, [$this, 'addLanguageColumn'], 50, 2);
                add_filter(BASE_FILTER_TABLE_HEADINGS, [$this, 'addLanguageTableHeading'], 50, 2);
                add_filter(LANGUAGE_FILTER_SWITCHER, [$this, 'languageSwitcher']);
                add_filter(BASE_FILTER_BEFORE_GET_FRONT_PAGE_ITEM, [$this, 'checkItemLanguageBeforeShow'], 50, 3);
                add_filter(BASE_FILTER_BEFORE_GET_SINGLE, [$this, 'getRelatedDataForOtherLanguage'], 50, 4);
                if (!is_in_admin()) {
                    add_filter(BASE_FILTER_GROUP_PUBLIC_ROUTE, [$this, 'addLanguageMiddlewareToPublicRoute'], 958, 1);
                }
                add_filter(BASE_FILTER_TABLE_BUTTONS, [$this, 'addLanguageSwitcherToTable'], 247, 2);
                add_filter(BASE_FILTER_TABLE_QUERY, [$this, 'getDataByCurrentLanguage'], 157, 3);
                add_filter(DASHBOARD_FILTER_ADMIN_NOTIFICATIONS, [$this, 'registerAdminAlert'], 2, 1);
                add_filter(BASE_FILTER_BEFORE_GET_ADMIN_LIST_ITEM, [$this, 'checkItemLanguageBeforeGetAdminListItem'],
                    50, 3);

                if (defined('THEME_OPTIONS_ACTION_META_BOXES')) {
                    add_filter(THEME_OPTIONS_ACTION_META_BOXES, [$this, 'addLanguageMetaBoxForThemeOptionsAndWidgets'],
                        55, 2);
                }

                if (defined('WIDGET_TOP_META_BOXES')) {
                    add_filter(WIDGET_TOP_META_BOXES, [$this, 'addLanguageMetaBoxForThemeOptionsAndWidgets'], 55, 2);
                }
            }
        }
    }

    /**
     * @param $screen
     */
    public function addLanguageBox($screen)
    {
        if (in_array($screen, Language::screenUsingMultiLanguage())) {
            add_meta_box('language_wrap', trans('plugins/language::language.name'), [$this, 'languageMetaField'],
                $screen, 'top', 'default');
        }
    }

    /**
     * @param $screen
     * @param $data
     * @return string
     * @throws \Throwable
     */
    public function addLanguageMetaBoxForThemeOptionsAndWidgets($data, $screen)
    {
        $route = null;
        switch ($screen) {
            case THEME_OPTIONS_MODULE_SCREEN_NAME:
                $route = 'theme.options';
                break;
            case WIDGET_MANAGER_MODULE_SCREEN_NAME:
                $route = 'widgets.list';
                break;
        }

        if (empty($route)) {
            return $data;
        }

        return $data . view('plugins/language::partials.admin-list-language-chooser', compact('route'))->render();
    }

    /**
     * @throws \Throwable
     */
    public function languageMetaField()
    {
        $languages = Language::getActiveLanguage([
            'lang_code',
            'lang_flag',
            'lang_name',
        ]);

        if ($languages->isEmpty()) {
            return null;
        }

        $related = [];
        $value = null;
        $args = func_get_args();

        $meta = null;

        $current_route = explode('.', Route::currentRouteName());
        $route = [
            'create' => Route::currentRouteName(),
            'edit'   => $current_route[0] . '.' . 'edit',
        ];

        $request = $this->app->make('request');

        if (!empty($args[0])) {
            $meta = $this->app->make(LanguageMetaInterface::class)->getFirstBy(
                [
                    'lang_meta_content_id' => $args[0]->id,
                    'lang_meta_reference'  => $args[1],
                ],
                [
                    'lang_meta_code',
                    'lang_meta_content_id',
                    'lang_meta_origin',
                ]
            );
            if (!empty($meta)) {
                $value = $meta->lang_meta_code;
            }

            $current_route = $current_route = explode('.', Route::currentRouteName());

            if (count($current_route) > 2) {
                $route = $current_route[0] . '.' . $current_route[1];
            } else {
                $route = $current_route[0];
            }

            $route = [
                'create' => $route . '.' . 'create',
                'edit'   => Route::currentRouteName(),
            ];
        } elseif ($request->input('ref_from')) {
            $meta = $this->app->make(LanguageMetaInterface::class)->getFirstBy(
                [
                    'lang_meta_content_id' => $request->input('ref_from'),
                    'lang_meta_reference'  => $args[1],
                ],
                [
                    'lang_meta_code',
                    'lang_meta_content_id',
                    'lang_meta_origin',
                ]
            );
            $value = $request->input('ref_lang');
        }
        if ($meta) {
            $related = Language::getRelatedLanguageItem($meta->lang_meta_content_id, $meta->lang_meta_origin);
        }
        $current_language = self::checkCurrentLanguage($languages, $value);

        if (!$current_language) {
            $current_language = Language::getDefaultLanguage([
                'lang_flag',
                'lang_name',
                'lang_code',
            ]);
        }

        $route = apply_filters(LANGUAGE_FILTER_ROUTE_ACTION, $route);
        return view('plugins/language::language-box',
            compact('args', 'languages', 'current_language', 'related', 'route'))->render();
    }

    /**
     * @param $value
     * @param $languages
     * @return mixed
     */
    public function checkCurrentLanguage($languages, $value)
    {
        $request = $this->app->make('request');
        $current_language = null;
        foreach ($languages as $language) {
            if ($value) {
                if ($language->lang_code == $value) {
                    $current_language = $language;
                }
            } else {
                if ($request->input('ref_lang')) {
                    if ($language->lang_code == $request->input('ref_lang')) {
                        $current_language = $language;
                    }
                } elseif ($language->lang_is_default) {
                    $current_language = $language;
                }
            }
        }

        if (empty($current_language)) {
            foreach ($languages as $language) {
                if ($language->lang_is_default) {
                    $current_language = $language;
                }
            }
        }

        return $current_language;
    }

    /**
     * @param $screen
     * @param \Illuminate\Http\Request $request
     * @param $data
     * @return void
     *
     * @since 2.1
     * @throws \Throwable
     */
    public function addCurrentLanguageEditingAlert($screen, $request, $data = null)
    {
        if (in_array($screen, Language::screenUsingMultiLanguage())) {
            $code = Language::getCurrentAdminLocaleCode();
            if (empty($code)) {
                $code = $this->getCurrentAdminLanguage($screen, $request, $data);
            }

            $language = null;
            if (!empty($code)) {
                Language::setCurrentAdminLocale($code);
                $language = $this->app->make(LanguageInterface::class)->getFirstBy(['lang_code' => $code],
                    ['lang_name']);
                if (!empty($language)) {
                    $language = $language->lang_name;
                }
            }
            echo view('plugins/language::partials.notification', compact('language'))->render();
        }
        echo null;
    }

    /**
     * @param $screen
     * @param \Illuminate\Http\Request $request
     * @param \Eloquent | null $data
     * @return null|string
     */
    public function getCurrentAdminLanguage($screen, $request, $data = null)
    {
        $code = null;
        if ($request->has('ref_lang')) {
            $code = $request->input('ref_lang');
        } elseif (!empty($data)) {
            $meta = $this->app->make(LanguageMetaInterface::class)->getFirstBy([
                'lang_meta_content_id' => $data->id,
                'lang_meta_reference'  => $screen,
            ], ['lang_meta_code']);
            if (!empty($meta)) {
                $code = $meta->lang_meta_code;
            }
        }

        if (empty($code)) {
            $code = Language::getDefaultLocaleCode();
        }

        Language::setCurrentAdminLocale($code);

        return $code;
    }

    /**
     * @param $headings
     * @param $screen
     * @return mixed
     *
     */
    public function addLanguageTableHeading($headings, $screen)
    {
        if (in_array($screen, Language::screenUsingMultiLanguage())) {
            $current_route = explode('.', Route::currentRouteName());

            if (count($current_route) > 2) {
                array_pop($current_route);
                $route = implode('.', $current_route);
            } else {
                $route = $current_route[0];
            }

            if (!Auth::user()->hasAnyPermission([$route . '.create', $route . '.edit'])) {
                return $headings;
            }

            $languages = Language::getActiveLanguage(['lang_code', 'lang_name', 'lang_flag']);
            $heading = '';
            foreach ($languages as $language) {
                $heading .= language_flag($language->lang_flag, $language->lang_name);
            }
            return array_merge($headings, [
                'language' => [
                    'name'      => 'language_meta.lang_meta_id',
                    'title'     => $heading,
                    'class'     => 'text-center language-header no-sort',
                    'width'     => (count($languages) * 40) . 'px',
                    'orderable' => false,
                ],
            ]);
        }
        return $headings;
    }

    /**
     * @param DataTableAbstract $data
     * @param $screen
     * @return mixed
     */
    public function addLanguageColumn($data, $screen)
    {
        if (in_array($screen, Language::screenUsingMultiLanguage())) {
            $current_route = explode('.', Route::currentRouteName());

            if (count($current_route) > 2) {
                array_pop($current_route);
                $route = implode('.', $current_route);
            } else {
                $route = $current_route[0];
            }

            if (!Auth::user()->hasAnyPermission([$route . '.create', $route . '.edit'])) {
                return $data;
            }

            return $data->addColumn('language', function ($item) use ($screen, $route) {
                $current_language = $this->app->make(LanguageMetaInterface::class)->getFirstBy([
                    'lang_meta_content_id' => $item->id,
                    'lang_meta_reference'  => $screen,
                ]);
                $related_languages = [];
                if ($current_language) {
                    $related_languages = Language::getRelatedLanguageItem($current_language->lang_meta_content_id,
                        $current_language->lang_meta_origin);
                    $current_language = $current_language->lang_meta_code;
                }
                $languages = Language::getActiveLanguage();
                $data = '';

                foreach ($languages as $language) {
                    if ($language->lang_code == $current_language) {
                        $data .= view('plugins/language::partials.status.active', compact('route', 'item'))->render();
                    } else {
                        $added = false;
                        if (!empty($related_languages)) {
                            foreach ($related_languages as $key => $related_language) {
                                if ($key == $language->lang_code) {
                                    $data .= view('plugins/language::partials.status.edit',
                                        compact('route', 'related_language'))->render();
                                    $added = true;
                                }
                            }
                        }
                        if (!$added) {
                            $data .= view('plugins/language::partials.status.plus',
                                compact('route', 'item', 'language'))->render();
                        }
                    }
                }

                return view('plugins/language::partials.language-column', compact('data'))->render();
            });
        }
        return $data;
    }

    /**
     * @param array $options
     * @return string
     *
     * @throws \Throwable
     */
    public function languageSwitcher($options = [])
    {
        $supported_locales = Language::getSupportedLocales();
        return view('plugins/language::partials.switcher', compact('options', 'supported_locales'))->render();
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $data
     * @param string $screen
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return mixed
     */
    public function checkItemLanguageBeforeShow($data, $model, $screen = null)
    {
        return $this->getDataByCurrentLanguageCode($data, $model, $screen, Language::getCurrentLocaleCode());
    }

    /**
     * @param Builder $data
     * @param Model $model
     * @param string $screen
     * @param $language_code
     * @return mixed
     */
    protected function getDataByCurrentLanguageCode($data, $model, $screen, $language_code)
    {
        if (!empty($screen) &&
            in_array($screen, Language::screenUsingMultiLanguage()) &&
            !empty($language_code) &&
            !$model instanceof \Botble\Language\Models\Language &&
            !$model instanceof LanguageMeta
        ) {
            if (Language::getCurrentAdminLocaleCode() !== 'all') {

                if ($model instanceof \Illuminate\Database\Eloquent\Builder) {
                    $model = $model->getModel();
                }

                $table = $model->getTable();
                $data = $data
                    ->join('language_meta', 'language_meta.lang_meta_content_id', $table . '.id')
                    ->where('language_meta.lang_meta_reference', '=', $screen)
                    ->where('language_meta.lang_meta_code', '=', $language_code);
            }

            return $data;
        }

        return $data;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $data
     * @param string $screen
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return mixed
     */
    public function checkItemLanguageBeforeGetAdminListItem($data, $model, $screen = null)
    {
        return $this->getDataByCurrentLanguageCode($data, $model, $screen, Language::getCurrentAdminLocaleCode());
    }

    /**
     * @param Builder $query
     * @param $screen
     * @param \Illuminate\Database\Eloquent\Builder $model
     * @return string
     */
    public function getRelatedDataForOtherLanguage($query, $model, $screen)
    {
        if (in_array($screen, Language::screenUsingMultiLanguage()) &&
            !$model instanceof \Botble\Language\Models\Language &&
            !$model instanceof LanguageMeta
        ) {
            $data = $query->first();

            if (!empty($data)) {
                $current = $this->app->make(LanguageMetaInterface::class)->getFirstBy([
                    'lang_meta_reference'  => $screen,
                    'lang_meta_content_id' => $data->id,
                ]);
                if ($current) {
                    Language::setCurrentAdminLocale($current->lang_meta_code);
                    if ($current->lang_meta_code != Language::getCurrentLocaleCode()) {
                        if (setting('language_show_default_item_if_current_version_not_existed',
                                true) == false && $screen != MENU_MODULE_SCREEN_NAME) {
                            return $data;
                        }
                        $meta = $this->app->make(LanguageMetaInterface::class)->getModel()
                            ->where('lang_meta_origin', '=', $current->lang_meta_origin)
                            ->where('lang_meta_content_id', '!=', $data->id)
                            ->where('lang_meta_code', '=', Language::getCurrentLocaleCode())
                            ->first();
                        if ($meta) {
                            $result = $model->where('id', '=', $meta->lang_meta_content_id);
                            if ($result) {
                                return $result;
                            }
                        }
                    }
                }
            }
        }
        return $query;
    }

    /**
     * @param $data
     * @return array
     */
    public function addLanguageMiddlewareToPublicRoute($data)
    {
        return array_merge_recursive($data, [
            'prefix'     => Language::setLocale(),
            'middleware' => [
                'localeSessionRedirect',
                'localizationRedirect',
            ],
        ]);
    }

    /**
     * @param $buttons
     * @param $screen
     * @return array
     *
     * @since 2.2
     */
    public function addLanguageSwitcherToTable($buttons, $screen)
    {
        if (in_array($screen, Language::screenUsingMultiLanguage())) {
            $active_languages = Language::getActiveLanguage(['lang_code', 'lang_name', 'lang_flag']);
            $language_buttons = [];
            $current_language = Language::getCurrentAdminLocaleCode();
            foreach ($active_languages as $item) {
                $language_buttons[] = [
                    'className' => 'change-data-language-item ' . ($item->lang_code == $current_language ? 'active' : ''),
                    'text'      => Html::tag('span', $item->lang_name,
                        ['data-href' => route('languages.change.data.language', $item->lang_code)])->toHtml(),
                ];
            }

            $language_buttons[] = [
                'className' => 'change-data-language-item ' . ('all' == $current_language ? 'active' : ''),
                'text'      => Html::tag('span', trans('plugins/language::language.show_all'),
                    ['data-href' => route('languages.change.data.language', 'all')])->toHtml(),
            ];

            $flag = $active_languages->where('lang_code', $current_language)->first();
            if (!empty($flag)) {
                $flag = language_flag($flag->lang_flag, $flag->lang_name);
            } else {
                $flag = Html::tag('i', '', ['class' => 'fa fa-flag'])->toHtml();
            }

            $language = [
                'language' => [
                    'extend'  => 'collection',
                    'text'    => $flag . Html::tag('span',
                            ' ' . trans('plugins/language::language.change_language') . ' ' . Html::tag('span', '',
                                ['class' => 'caret'])->toHtml())->toHtml(),
                    'buttons' => $language_buttons,
                ],
            ];
            $buttons = array_merge($buttons, $language);
        }

        return $buttons;
    }

    /**
     * @param Builder $query
     * @param Model $model
     * @param string $screen
     * @return mixed
     *
     * @since 2.2
     */
    public function getDataByCurrentLanguage($query, $model, $screen = null)
    {
        if (!empty($screen) &&
            in_array($screen, Language::screenUsingMultiLanguage()) &&
            Language::getCurrentAdminLocaleCode()
        ) {

            if (Language::getCurrentAdminLocaleCode() !== 'all') {
                /**
                 * @var \Eloquent $model
                 */
                $table = $model->getTable();
                $query = $query
                    ->join('language_meta', 'language_meta.lang_meta_content_id', $table . '.id')
                    ->where('language_meta.lang_meta_reference', '=', $screen)
                    ->where('language_meta.lang_meta_code', '=', Language::getCurrentAdminLocaleCode());
            }
        }
        return $query;
    }

    /**
     * @param string $alert
     * @return string
     *
     * @throws \Throwable
     */
    public function registerAdminAlert($alert)
    {
        return $alert . view('plugins/language::partials.admin-language-switcher')->render();
    }
}
