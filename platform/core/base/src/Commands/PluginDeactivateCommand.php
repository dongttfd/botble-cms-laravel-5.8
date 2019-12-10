<?php

namespace Botble\Base\Commands;

use Botble\Setting\Supports\SettingStore;
use Composer\Autoload\ClassLoader;
use Exception;
use File;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class PluginDeactivateCommand extends Command
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
    protected $signature = 'cms:plugin:deactivate {name : The plugin that you want to deactivate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate a plugin in /plugins directory';

    /**
     * @var SettingStore
     */
    protected $settingStore;

    /**
     * Create a new key generator command.
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     * @param SettingStore $settingStore
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

            if (!class_exists($content['provider'])) {
                $loader = new ClassLoader;
                $loader->setPsr4($content['namespace'], plugin_path($plugin . '/src'));
                $loader->register(true);
            }

            $activated_plugins = get_active_plugins();
            if (in_array($plugin, $activated_plugins)) {
                if (class_exists($content['namespace'] . 'Plugin')) {
                    call_user_func([$content['namespace'] . 'Plugin', 'deactivate']);
                }
                if (($key = array_search($plugin, $activated_plugins)) !== false) {
                    unset($activated_plugins[$key]);
                }
                $this->settingStore
                    ->set('activated_plugins', json_encode(array_values($activated_plugins)))
                    ->save();

                $this->call('cache:clear');
                $this->line('<info>Deactivate plugin successfully!</info>');
            } else {
                $this->line('<info>This plugin is deactivated already!</info>');
            }
        }

        return true;
    }
}
