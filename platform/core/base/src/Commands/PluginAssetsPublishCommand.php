<?php

namespace Botble\Base\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem as File;

class PluginAssetsPublishCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'cms:plugin:assets:publish {name : The plugin that you want to publish assets}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish assets for a plugin';

    /**
     * @var File
     */
    protected $files;

    /**
     * Create a new command instance.
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     */
    public function __construct(File $files)
    {
        $this->files = $files;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return bool
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
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

        $content = get_file_data($location . '/plugin.json');
        if (!empty($content)) {
            $this->call('vendor:publish', [
                '--tag'      => 'public',
                '--provider' => $content['provider'],
                '--force'    => true,
            ]);
        }

        $this->info('Publish assets for plugin ' . $plugin . ' successfully!');

        return true;
    }
}
