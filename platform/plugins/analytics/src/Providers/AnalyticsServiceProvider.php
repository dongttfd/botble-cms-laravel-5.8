<?php

namespace Botble\Analytics\Providers;

use Botble\Analytics\Analytics;
use Botble\Analytics\AnalyticsClient;
use Botble\Analytics\AnalyticsClientFactory;
use Botble\Analytics\Facades\AnalyticsFacade;
use Botble\Base\Supports\Helper;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Botble\Analytics\Exceptions\InvalidConfiguration;

class AnalyticsServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Register the service provider.
     */
    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

        $this->app->bind(AnalyticsClient::class, function () {
            return AnalyticsClientFactory::createForConfig(config('plugins.analytics.general'));
        });

        $this->app->bind(Analytics::class, function () {
            if (empty(setting('analytics_view_id', config('plugins.analytics.general.view_id')))) {
                throw InvalidConfiguration::viewIdNotSpecified();
            }

            if (!setting('analytics_service_account_credentials')) {
                throw InvalidConfiguration::credentialsIsNotValid();
            }

            return new Analytics(
                $this->app->make(AnalyticsClient::class),
                setting('analytics_view_id', config('plugins.analytics.general.view_id'))
            );
        });

        AliasLoader::getInstance()->alias('Analytics', AnalyticsFacade::class);
    }

    /**
     * Bootstrap the application events.
     *
     */
    public function boot()
    {
        $this->setNamespace('plugins/analytics')
            ->loadAndPublishConfigurations(['general', 'permissions'])
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->publishPublicFolder()
            ->publishAssetsFolder();

        $this->app->register(HookServiceProvider::class);
    }
}
