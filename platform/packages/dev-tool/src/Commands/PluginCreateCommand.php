<?php

namespace Botble\DevTool\Commands;

use Botble\DevTool\Commands\Abstracts\BaseMakeCommand;
use File;

class PluginCreateCommand extends BaseMakeCommand
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'cms:plugin:create {name : The plugin that you want to create} {--force : Overwrite any existing files.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a plugin in the /platform/plugins directory.';

    /**
     * Execute the console command.
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \League\Flysystem\FileNotFoundException
     */
    public function handle()
    {
        if (!preg_match('/^[a-z0-9\-]+$/i', $this->argument('name'))) {
            $this->error('Only alphabetic characters are allowed.');
            return false;
        }

        $plugin = strtolower($this->argument('name'));
        $location = plugin_path($plugin);

        if (File::isDirectory($location)) {
            $this->error('A plugin named [' . $plugin . '] already exists.');
            return false;
        }

        $this->publishStubs($this->getStub(), $location);
        $this->renameFiles($plugin, $location);
        $this->searchAndReplaceInFiles($plugin, $location);
        $this->removeUnusedFiles($location);
        $this->line('------------------');
        $this->line('<info>The plugin</info> <comment>' . $plugin . '</comment> <info>was created in</info> <comment>' . $location . '</comment><info>, customize it!</info>');
        $this->line('------------------');
        $this->call('cache:clear');

        return true;
    }

    /**
     * @param string $replaceText
     * @return array
     */
    public function getReplacements(string $replaceText)
    {
        return [

        ];
    }

    /**
     * @return string
     */
    public function getStub()
    {
        return __DIR__ . '/../../stubs/package';
    }

    /**
     * @param string $location
     */
    protected function removeUnusedFiles(string $location)
    {
        $files = [
            'composer.json',
        ];

        foreach ($files as $file) {
            File::delete($location . '/' . $file);
        }
    }
}
