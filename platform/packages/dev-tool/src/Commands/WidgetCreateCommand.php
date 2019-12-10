<?php

namespace Botble\DevTool\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem as File;
use Illuminate\Support\Str;
use League\Flysystem\Adapter\Local as LocalAdapter;
use League\Flysystem\Filesystem as Flysystem;
use League\Flysystem\MountManager;
use Symfony\Component\Console\Input\InputArgument;

class WidgetCreateCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'cms:widget:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new widget';

    /**
     * @var File
     */
    protected $files;

    /**
     * Create a new command instance.
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     *
     */
    public function __construct(File $files)
    {
        $this->files = $files;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return boolean
     *
     */
    public function handle()
    {
        if ($this->files->isDirectory($this->getPath())) {
            $this->error('Widget "' . $this->getWidget() . '" is already exists.');
            return false;
        }

        // Directories.
        $this->publishStubs();

        $this->searchAndReplaceInFiles();
        $this->renameFiles($this->getPath());

        $this->info('Widget "' . $this->getWidget() . '" has been created.');
        return true;
    }

    /**
     * Generate the module in Modules directory.
     *
     */
    protected function publishStubs()
    {
        $from = $this->getStub();

        if ($this->files->isDirectory($from)) {
            $this->publishDirectory($from, $this->getPath());
        } else {
            $this->error('Can’t locate path: <' . $from . '>');
        }
    }

    /**
     * @return string
     */
    public function getStub()
    {
        return __DIR__ . '/../../stubs/widget';
    }

    /**
     * Publish the directory to the given directory.
     *
     * @param string $from
     * @param string $to
     * @return void
     *
     */
    protected function publishDirectory($from, $to)
    {
        $manager = new MountManager([
            'from' => new Flysystem(new LocalAdapter($from)),
            'to'   => new Flysystem(new LocalAdapter($to)),
        ]);

        foreach ($manager->listContents('from://', true) as $file) {
            if ($file['type'] === 'file' && (!$manager->has('to://' . $file['path']) || $this->option('force'))) {
                $manager->put('to://' . $file['path'], $manager->read('from://' . $file['path']));
            }
        }
    }

    /**
     * Search and replace all occurrences of ‘Module’
     * in all files with the name of the new module.
     *
     */
    public function searchAndReplaceInFiles()
    {
        $path = $this->getPath();

        $manager = new MountManager([
            'directory' => new Flysystem(new LocalAdapter($path)),
        ]);

        foreach ($manager->listContents('directory://', true) as $file) {
            if ($file['type'] === 'file') {
                $content = str_replace(['{widget}', '{Widget}',], [strtolower($this->getWidget()), Str::studly($this->getWidget())], $manager->read('directory://' . $file['path']));
                $manager->put('directory://' . $file['path'], $content);
            }
        }
    }

    /**
     * Rename models and repositories.
     * @param $location
     * @return boolean
     *
     */
    public function renameFiles($location)
    {
        $paths = scan_folder($location);
        if (empty($paths)) {
            return false;
        }
        foreach ($paths as $path) {
            $path = $location . DIRECTORY_SEPARATOR . $path;

            $newPath = $this->transformFilename($path);
            rename($path, $newPath);

            $this->renameFiles($newPath);
        }
        return true;
    }

    /**
     * Rename file in path.
     * @param $path
     * @return string
     *
     */
    public function transformFilename($path)
    {
        return str_replace(
            ['{widget}', '{Widget}', '.stub'],
            [$this->getWidget(), Str::studly($this->getWidget()), '.php',],
            $path
        );
    }


    /**
     * Get the destination view path.
     *
     * @return string
     *
     */
    protected function getPath()
    {
        return theme_path(setting('theme') . '/widgets/' . $this->getWidget());
    }

    /**
     * Get the theme name.
     *
     * @return string
     *
     */
    protected function getWidget()
    {
        return strtolower($this->argument('name'));
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     *
     */
    protected function getArguments()
    {
        return [
            [
                'name',
                InputArgument::REQUIRED,
                'Name of the theme to generate.',
            ],
        ];
    }
}
