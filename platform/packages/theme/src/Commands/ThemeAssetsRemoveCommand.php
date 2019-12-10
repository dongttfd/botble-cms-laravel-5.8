<?php

namespace Botble\Theme\Commands;

use Botble\Theme\Commands\Traits\ThemeTrait;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem as File;

class ThemeAssetsRemoveCommand extends Command
{
    use ThemeTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = '
        cms:theme:assets:remove 
        {name : The theme that you want to publish assets}
        {--path= : Path to theme directory}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove assets for a theme';

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

        $this->files->deleteDirectory(public_path('themes/' . $this->getTheme()));

        $this->info('Remove assets of a theme ' . $this->getTheme() . ' successfully!');
        return true;
    }
}
