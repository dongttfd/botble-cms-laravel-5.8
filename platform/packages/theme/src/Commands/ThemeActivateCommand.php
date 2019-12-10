<?php

namespace Botble\Theme\Commands;

use Botble\Setting\Supports\SettingStore;
use Botble\Theme\Commands\Traits\ThemeTrait;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem as File;

class ThemeActivateCommand extends Command
{

    use ThemeTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'cms:theme:activate 
        {name : The theme that you want to activate} 
        {--path= : Path to theme directory}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Activate a theme';

    /**
     * @var File
     */
    protected $files;

    /**
     * @var SettingStore
     */
    protected $settingStore;

    /**
     * @var ThemeAssetsPublishCommand
     */
    protected $themeAssetsPublishCommand;

    /**
     * Create a new command instance.
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     * @param SettingStore $settingStore
     * @param ThemeAssetsPublishCommand $themeAssetsPublishCommand
     */
    public function __construct(
        File $files,
        SettingStore $settingStore,
        ThemeAssetsPublishCommand $themeAssetsPublishCommand
    )
    {
        $this->files = $files;
        $this->settingStore = $settingStore;
        $this->themeAssetsPublishCommand = $themeAssetsPublishCommand;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
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

        $this->settingStore
            ->set('theme', $this->getTheme())
            ->save();

        $this->call($this->themeAssetsPublishCommand->getName(), ['name' => $this->getTheme()]);
        $this->info('Activate theme ' . $this->argument('name') . ' successfully!');
        $this->call('cache:clear');
        return true;
    }
}
