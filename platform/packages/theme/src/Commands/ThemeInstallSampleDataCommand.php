<?php

namespace Botble\Theme\Commands;

use Botble\Setting\Supports\SettingStore;
use DB;
use File;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class ThemeInstallSampleDataCommand extends Command
{

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'cms:theme:install-sample-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install sample data for current active theme';

    /**
     * @var SettingStore
     */
    protected $settingStore;

    /**
     * @var ThemeActivateCommand
     */
    protected $themeActivateCommand;

    /**
     * ThemeInstallSampleDataCommand constructor.
     * @param SettingStore $settingStore
     * @param ThemeActivateCommand $themeActivateCommand
     */
    public function __construct(SettingStore $settingStore, ThemeActivateCommand $themeActivateCommand)
    {
        parent::__construct();
        $this->settingStore = $settingStore;
        $this->themeActivateCommand = $themeActivateCommand;
    }

    /**
     * Execute the console command.
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $this->info('Processing ...');

        $theme = $this->settingStore->get('theme');
        if (!$theme) {
            $theme = Arr::first(scan_folder(theme_path()));
            $this->settingStore
                ->set('theme', $theme)
                ->save();
        }

        $content = get_file_data(theme_path($theme . '/theme.json'));

        if (!empty($content)) {
            $required_plugins = Arr::get($content, 'required_plugins', []);
            if (!empty($required_plugins)) {
                $this->info('Activating required plugins ...');
                foreach ($required_plugins as $required_plugin) {
                    $this->info('Activating plugin "' . $required_plugin . '"');
                    $this->call($this->themeActivateCommand->getName(), ['name' => $required_plugin]);
                }
            }
        }

        $database = theme_path($theme . '/data/sample.sql');

        if (File::exists($database)) {

            $this->info('Importing sample data...');
            // Force the new login to be used
            DB::purge();
            DB::unprepared('USE `' . env('DB_DATABASE') . '`');
            DB::connection()->setDatabaseName(env('DB_DATABASE'));
            DB::unprepared(File::get($database));
        }

        $this->info('Done!');

        return true;
    }
}
