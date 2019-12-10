<?php

namespace Botble\DevTool\Commands\Make;

use Botble\DevTool\Commands\Abstracts\BaseMakeCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class ModelMakeCommand extends BaseMakeCommand
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
    protected $signature = 'cms:make:model {name : The table that you want to create} {plugin : Plugin name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a model';

    /**
     * Create a new key generator command.
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     *
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @throws \League\Flysystem\FileNotFoundException
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        if (!preg_match('/^[a-z0-9\-\_]+$/i', $this->argument('name'))) {
            $this->error('Only alphabetic characters are allowed.');
            return false;
        }

        $name = $this->argument('name');
        $path = plugin_path(strtolower($this->argument('plugin')) . '/src/Models/' . ucfirst(Str::studly($name)) . '.php');

        $this->publishStubs($this->getStub(), $path);
        $this->renameFiles($name, $path);
        $this->searchAndReplaceInFiles($name, $path);
        $this->line('------------------');

        $this->info('Create successfully!');

        return true;
    }

    /**
     * @return string
     */
    public function getStub()
    {
        return __DIR__ . '/../../../stubs/package/src/Models/{Plugin}.stub';
    }

    /**
     * @param string $replaceText
     * @return array
     */
    public function getReplacements(string $replaceText)
    {
        return [];
    }
}
