<?php

namespace Botble\DevTool\Commands;

use Botble\DevTool\Commands\Abstracts\BaseMakeCommand;
use File;

class PackageCreateCommand extends BaseMakeCommand
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'cms:package:create {name : The package name} {--force : Overwrite any existing files.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a package in the /platform/packages directory.';

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

        $package = strtolower($this->argument('name'));
        $location = package_path($package);

        if (File::isDirectory($location)) {
            $this->error('A package named [' . $package . '] already exists.');
            return false;
        }

        $this->publishStubs($this->getStub(), $location);
        $this->renameFiles($package, $location);
        $this->searchAndReplaceInFiles($package, $location);
        $this->removeUnusedFiles($location);
        $this->line('------------------');
        $this->line('<info>The package</info> <comment>' . $package . '</comment> <info>was created in</info> <comment>' . $location . '</comment><info>, customize it!</info>');
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
            '{type}' => 'packages',
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
            'plugin.json',
            'src/Plugin.php',
        ];

        foreach ($files as $file) {
            File::delete($location . '/' . $file);
        }
    }
}
