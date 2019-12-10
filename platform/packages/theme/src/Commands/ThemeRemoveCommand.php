<?php

namespace Botble\Theme\Commands;

use Botble\Setting\Repositories\Interfaces\SettingInterface;
use Botble\Setting\Supports\SettingStore;
use Botble\Theme\Commands\Traits\ThemeTrait;
use Botble\Theme\Events\ThemeRemoveEvent;
use Botble\Widget\Repositories\Interfaces\WidgetInterface;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem as File;

class ThemeRemoveCommand extends Command
{

    use ThemeTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'cms:theme:remove 
        {name : The theme that you want to remove} 
        {--force : Force to remove theme without confirmation} 
        {--path= : Path to theme directory}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove an existing theme';

    /**
     * @var File
     */
    protected $files;

    /**
     * @var WidgetInterface
     */
    protected $widgetRepository;

    /**
     * @var SettingInterface
     */
    protected $settingRepository;

    /**
     * @var SettingStore
     */
    protected $settingStore;

    /**
     * @var ThemeAssetsRemoveCommand
     */
    protected $themeAssetsRemoveCommand;

    /**
     * Create a new command instance.
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     * @param WidgetInterface $widgetRepository
     * @param SettingInterface $settingRepository
     * @param SettingStore $settingStore
     * @param ThemeAssetsRemoveCommand $themeAssetsRemoveCommand
     */
    public function __construct(
        File $files,
        WidgetInterface $widgetRepository,
        SettingInterface $settingRepository,
        SettingStore $settingStore,
        ThemeAssetsRemoveCommand $themeAssetsRemoveCommand
    )
    {
        $this->files = $files;
        $this->widgetRepository = $widgetRepository;
        $this->settingRepository = $settingRepository;
        $this->settingStore = $settingStore;
        $this->themeAssetsRemoveCommand = $themeAssetsRemoveCommand;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return bool
     */
    public function handle()
    {
        if (!preg_match('/^[a-z0-9\-]+$/i', $this->argument('name'))) {
            $this->error('Only alphabetic characters are allowed.');
            return false;
        }

        // The theme is not exists.
        if (!$this->files->isDirectory($this->getPath(null))) {
            $this->error('Theme "' . $this->getTheme() . '" is not exists.');
            return false;
        }

        if ($this->settingStore->get('theme') == $this->getTheme()) {
            $this->error('Cannot remove activated theme, please activate another theme before removing "' . $this->getTheme() . '"!');
            return false;
        }

        $themePath = $this->getPath(null);

        if (app()->runningInConsole() &&
            $this->confirm('Are you sure you want to permanently delete? [yes|no]', $this->hasOption('force'))
        ) {
            return $this->processRemove($themePath);
        }
        return $this->processRemove($themePath);
    }

    /**
     * @param $themePath
     * @return boolean
     */
    protected function processRemove($themePath)
    {
        $this->call($this->themeAssetsRemoveCommand->getName(), ['name' => $this->getTheme()]);

        // Delete permanent.
        $this->files->deleteDirectory($themePath, false);
        $this->widgetRepository->deleteBy(['theme' => $this->getTheme()]);
        $this->settingRepository->getModel()
            ->where('key', 'like', 'theme-' . $this->getTheme() . '-%')
            ->delete();

        event(new ThemeRemoveEvent($this->getTheme()));

        $this->info('Theme "' . $this->getTheme() . '" has been destroyed.');
        return true;
    }
}
