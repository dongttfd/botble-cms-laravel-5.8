<?php

namespace Botble\DevTool\Commands\Make;

use Botble\DevTool\Commands\Abstracts\BaseMakeCommand;
use File;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class RepositoryMakeCommand extends BaseMakeCommand
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
    protected $signature = 'cms:make:repository {name : The table that you want to create} {plugin : Plugin name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a repository';

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

        $this->publishFile($this->getStub() . '/Interfaces/{Plugin}Interface.stub', $name, 'Interfaces', 'Interface.php');
        $this->publishFile($this->getStub() . '/Eloquent/{Plugin}Repository.stub', $name, 'Eloquent', 'Repository.php');
        $this->publishFile($this->getStub() . '/Caches/{Plugin}CacheDecorator.stub', $name, 'Caches', 'CacheDecorator.php');

        $this->line('------------------');

        $this->info('Create successfully!');

        return true;
    }

    /**
     * @param $stub
     * @param $name
     * @param $prefix
     * @param $extension
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \League\Flysystem\FileNotFoundException
     */
    protected function publishFile($stub, $name, $prefix, $extension)
    {
        $path = plugin_path(strtolower($this->argument('plugin')) . '/src/Repositories/' . $prefix . '/' . ucfirst(Str::studly($name)) . $extension);

        $this->publishStubs($stub, $path);
        $this->renameFiles($stub, $path);
        $this->searchAndReplaceInFiles($name, $path, File::get($stub));
    }

    /**
     * @return string
     */
    public function getStub()
    {
        return __DIR__ . '/../../../stubs/package/src/Repositories';
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
