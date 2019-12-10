<?php

namespace Botble\Base\Commands;

use Botble\Setting\Supports\SettingStore;
use Composer\Autoload\ClassLoader;
use Exception;
use File;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;

class PluginActivateCommand extends Command
{

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'cms:plugin:activate {name : The plugin that you want to activate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Activate a plugin in /plugins directory';

    /**
     * @var SettingStore
     */
    protected $settingStore;

    /**
     * Create a new key generator command.
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     * @param SettingStore $settingStore
     *
     */
    public function __construct(Filesystem $files, SettingStore $settingStore)
    {
        parent::__construct();

        $this->files = $files;
        $this->settingStore = $settingStore;
    }

    /**
     * @throws Exception
     * @return boolean
     *
     */
    public function handle()
    {
        if (!preg_match('/^[a-z0-9\-]+$/i', $this->argument('name'))) {
            $this->error('Only alphabetic characters are allowed.');
            return false;
        }

        $plugin = strtolower($this->argument('name'));
        $location = plugin_path($plugin);

        if (!$this->files->isDirectory($location)) {
            $this->error('This plugin is not exists.');
            return false;
        }

        if (!File::exists($location . '/plugin.json')) {
            $this->warn('Missing file plugin.json!');
            return true;
        }

        $content = get_file_data($location . '/plugin.json');
        if (!empty($content)) {
            $activated_plugins = get_active_plugins();
            if (!in_array($plugin, $activated_plugins)) {

                if (!empty(Arr::get($content, 'require'))) {
                    $valid = count(array_intersect($content['require'], $activated_plugins)) == count($content['require']);
                    if (!$valid) {
                        $this->error('<info>Please activate plugin(s): ' . implode(',', $content['require']) . ' before activate this plugin!</info>');
                        return false;
                    }
                }

                if (!class_exists($content['provider'])) {
                    $loader = new ClassLoader;
                    $loader->setPsr4($content['namespace'], plugin_path($plugin . '/src'));
                    $loader->register(true);

                    if (class_exists($content['namespace'] . 'Plugin')) {
                        call_user_func([$content['namespace'] . 'Plugin', 'activate']);
                    }

                    if (File::isDirectory(plugin_path($plugin . '/public'))) {
                        File::copyDirectory(plugin_path($plugin . '/public'), public_path('vendor/core/plugins/' . $plugin));

                        $this->call('vendor:publish', [
                            '--force'    => true,
                            '--tag'      => 'public',
                            '--provider' => $content['provider'],
                        ]);
                    }

                    if (File::isDirectory(plugin_path($plugin . '/database/migrations'))) {
                        $this->call('migrate', [
                            '--force' => true,
                            '--path'  => str_replace(base_path(), '', plugin_path($plugin . '/database/migrations')),
                        ]);
                    }
                }

                $this->settingStore
                    ->set('activated_plugins', json_encode(array_values(array_merge($activated_plugins, [$plugin]))))
                    ->save();

                $this->call('cache:clear');

                $this->line('<info>Activate plugin successfully!</info>');
            } else {
                $this->line('<info>This plugin is activated already!</info>');
            }
        }
        return true;
    }
}
