<?php

namespace Botble\Base\Providers;

use Composer\Autoload\ClassLoader;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Schema;

class PluginServiceProvider extends ServiceProvider
{
    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \Exception
     *
     */
    public function boot()
    {
        if (check_database_connection() && Schema::hasTable('settings')) {
            $plugins = get_active_plugins();
            if (!empty($plugins) && is_array($plugins)) {
                $loader = new ClassLoader;
                $providers = [];
                $namespaces = [];
                if (cache()->has('plugin_namespaces') && cache()->has('plugin_providers')) {
                    $providers = cache('plugin_providers');
                    if (!is_array($providers) || empty($providers)) {
                        $providers = [];
                    }

                    $namespaces = cache('plugin_namespaces');

                    if (!is_array($namespaces) || empty($namespaces)) {
                        $namespaces = [];
                    }
                }

                if (empty($namespaces) || empty($providers)) {
                    foreach ($plugins as $plugin) {
                        $plugin_path = plugin_path($plugin);

                        if (file_exists($plugin_path . '/plugin.json')) {
                            $content = get_file_data($plugin_path . '/plugin.json');
                            if (!empty($content)) {
                                if (Arr::has($content, 'namespace') && !class_exists($content['provider'])) {
                                    $namespaces[$plugin] = $content['namespace'];
                                }

                                $providers[] = $content['provider'];
                            }
                        }
                    }
                    cache()->forever('plugin_namespaces', $namespaces);
                    cache()->forever('plugin_providers', $providers);
                }

                foreach ($namespaces as $key => $namespace) {
                    $loader->setPsr4($namespace, plugin_path($key . '/src'));
                }

                $loader->register();

                foreach ($providers as $provider) {
                    if (!class_exists($provider)) {
                        continue;
                    }

                    $this->app->register($provider);
                }
            }
        }
    }
}
