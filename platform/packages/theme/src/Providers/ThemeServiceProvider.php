<?php

namespace Botble\Theme\Providers;

use Botble\Base\Supports\Helper;
use Botble\Theme\Commands\ThemeAssetsPublishCommand;
use Botble\Theme\Commands\ThemeAssetsRemoveCommand;
use Botble\Theme\Commands\ThemeInstallSampleDataCommand;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Theme\Commands\ThemeActivateCommand;
use Botble\Theme\Commands\ThemeRemoveCommand;
use Botble\Theme\Contracts\Theme as ThemeContract;
use Botble\Theme\Facades\ManagerFacade;
use Botble\Theme\Facades\ThemeFacade;
use Botble\Theme\Facades\ThemeOptionFacade;
use Botble\Theme\Theme;
use Event;
use File;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Schema;

class ThemeServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    public function register()
    {
        AliasLoader::getInstance()->alias('Theme', ThemeFacade::class);
        AliasLoader::getInstance()->alias('ThemeOption', ThemeOptionFacade::class);
        AliasLoader::getInstance()->alias('ThemeManager', ManagerFacade::class);

        Helper::autoload(__DIR__ . '/../../helpers');

        $this->app->bind(ThemeContract::class, Theme::class);

        $this->commands([
            ThemeActivateCommand::class,
            ThemeRemoveCommand::class,
            ThemeInstallSampleDataCommand::class,
            ThemeAssetsPublishCommand::class,
            ThemeAssetsRemoveCommand::class,
        ]);
    }

    /**
     *
     */
    public function boot()
    {
        $this->setNamespace('packages/theme')
            ->loadAndPublishConfigurations(['general', 'permissions'])
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->publishAssetsFolder()
            ->publishPublicFolder();

        $this->app->register(HookServiceProvider::class);

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()
                ->registerItem([
                    'id'          => 'cms-core-appearance',
                    'priority'    => 996,
                    'parent_id'   => null,
                    'name'        => 'core/base::layouts.appearance',
                    'icon'        => 'fa fa-paint-brush',
                    'url'         => '#',
                    'permissions' => [],
                ])
                ->registerItem([
                    'id'          => 'cms-core-theme',
                    'priority'    => 1,
                    'parent_id'   => 'cms-core-appearance',
                    'name'        => 'core/base::layouts.theme',
                    'icon'        => null,
                    'url'         => route('theme.list'),
                    'permissions' => ['theme.list'],
                ])
                ->registerItem([
                    'id'          => 'cms-core-theme-option',
                    'priority'    => 4,
                    'parent_id'   => 'cms-core-appearance',
                    'name'        => 'packages/theme::theme.theme_options',
                    'icon'        => null,
                    'url'         => route('theme.options'),
                    'permissions' => ['theme.options'],
                ])
                ->registerItem([
                    'id'          => 'cms-core-appearance-custom-css',
                    'priority'    => 5,
                    'parent_id'   => 'cms-core-appearance',
                    'name'        => 'packages/theme::theme.custom_css',
                    'icon'        => null,
                    'url'         => route('theme.custom-css'),
                    'permissions' => ['theme.custom-css'],
                ]);

            admin_bar()->registerLink('Theme', route('theme.list'), 'appearance');
        });

        $this->app->booted(function () {
            $file = public_path(config('packages.theme.general.themeDir') . '/' . setting('theme') . '/css/style.integration.css');
            if (File::exists($file)) {
                ThemeFacade::getFacadeRoot()
                    ->asset()
                    ->container('after_header')
                    ->add('theme-style-integration-css', config('packages.theme.general.themeDir') . '/' . setting('theme') . '/css/style.integration.css');
            }

            if (check_database_connection() && Schema::hasTable('settings')) {
                $theme = setting('theme');
                if (!$theme) {
                    setting()->set('theme', Arr::first(scan_folder(theme_path())));
                }
            }
        });

        $this->app->register(ThemeManagementServiceProvider::class);
    }
}
