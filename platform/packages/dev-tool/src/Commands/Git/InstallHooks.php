<?php

namespace Botble\DevTool\Commands\Git;

use Illuminate\Console\Command;
use ReflectionClass;
use RuntimeException;

class InstallHooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'git:install-hooks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install GIT hooks';

    /**
     * The hooks to install
     *
     * @var array<string>
     */
    protected $hooks = [
        'pre-commit' => PreCommitHook::class,
    ];

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \ReflectionException
     */
    public function handle()
    {
        if (!app()->isLocal()) {
            return false;
        }

        foreach ($this->hooks as $hook => $command) {
            $this->installHook($hook, $command)
                ? $this->info('Hook ' . $hook . ' successfully installed')
                : $this->error('Unable to install ' . $hook . ' hook');
        }


        return true;
    }

    /**
     * Install the hook command
     *
     * @param  string $class
     * @return boolean
     * @throws \ReflectionException
     */
    protected function installHook(string $hook, string $class): bool
    {
        $signature = $this->getCommandSignature($class);
        $script = $this->getHookScript($signature);
        $path = base_path('.git/hooks/' . $hook);

        if (file_exists($path) && md5_file($path) != md5($script)) {
            $answer = $this->confirm($path . ' already exists, do you want to overwrite it?');

            if (!$answer) {
                return false;
            }
        }

        return $this->writeHookScript($path, $script);
    }

    /**
     * Get the given command's class signature (e.g. cms:git:pre-commit-hook)
     *
     * @param  string $class
     * @return string
     * @throws \ReflectionException
     */
    protected function getCommandSignature(string $class): string
    {
        $reflect = new ReflectionClass($class);
        $properties = $reflect->getDefaultProperties();

        if (!preg_match('/^(\S+)/', $properties['signature'], $matches)) {
            throw new RuntimeException('Cannot read signature of ' . $class);
        }

        list(, $signature) = $matches;

        return $signature;
    }

    /**
     * Get the hook script content
     *
     * @param  string $signature
     * @return string
     */
    protected function getHookScript(string $signature): string
    {
        $artisan = base_path('artisan');

        return "#!/bin/sh\n/usr/bin/env php " . $artisan . ' ' . $signature . "\n";
    }

    /**artisan
     * Writes the git hook script file and return true on success, false
     * otherwise
     *
     * @param  string $path
     * @param  string $script
     * @return boolean
     */
    protected function writeHookScript(string $path, string $script): bool
    {
        if (!$result = file_put_contents($path, $script)) {
            return false;
        }

        // read + write for owner, execute for everyone
        if (!chmod($path, 0755)) {
            return false;
        }

        return true;
    }
}
