<?php

namespace Botble\Theme\Commands;

use Botble\Theme\Commands\Traits\ThemeTrait;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem as File;

class ThemeAssetsPublishCommand extends Command
{
    use ThemeTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = '
        cms:theme:assets:publish 
        {name : The theme that you want to publish assets}
        {--path= : Path to theme directory}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish assets for a theme';

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
     */
    public function handle()
    {
        if (!preg_match('/^[a-z0-9\-]+$/i', $this->argument('name'))) {
            $this->error('Only alphabetic characters are allowed.');
            return false;
        }

        if (!$this->files->isDirectory($this->getPath(null))) {
            $this->error('Theme "' . $this->getTheme() . '" is not exists.');
            return false;
        }

        $resourcePath = $this->getPath('public');
        $publishPath = public_path('themes/' . $this->getTheme());

        if (!$this->files->isDirectory($publishPath)) {
            $this->files->makeDirectory($publishPath, 0755, true);
        }

        $this->files->copyDirectory($resourcePath, $publishPath);
        $this->files->copy($this->getPath('screenshot.png'), $publishPath . '/screenshot.png');

        $this->info('Publish assets for theme ' . $this->getTheme() . ' successfully!');
        return true;
    }
}
