<?php

namespace Botble\Base\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class ClearLogCommand extends Command
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
    protected $signature = 'cms:log:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear log files';

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
     */
    public function handle()
    {
        foreach ($this->files->allFiles(storage_path('logs')) as $file) {
            $this->files->delete($file->getPathname());
        }
        $this->info('Clear log files successfully!');
    }
}
