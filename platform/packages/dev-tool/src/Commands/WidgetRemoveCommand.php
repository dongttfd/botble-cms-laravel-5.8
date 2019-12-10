<?php

namespace Botble\DevTool\Commands;

use Botble\Widget\Repositories\Interfaces\WidgetInterface;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem as File;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class WidgetRemoveCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'cms:widget:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove a widget';

    /**
     * @var File
     */
    protected $files;

    /**
     * @var WidgetInterface
     */
    protected $widgetRepository;

    /**
     * Create a new command instance.
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     * @param WidgetInterface $widgetRepository
     *
     */
    public function __construct(File $files, WidgetInterface $widgetRepository)
    {
        $this->files = $files;
        $this->widgetRepository = $widgetRepository;

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
        if (!$this->files->isDirectory($this->getPath())) {
            $this->error('Widget "' . $this->getWidget() . '" is not existed.');
            return false;
        }

        try {
            $this->files->deleteDirectory($this->getPath());
            $this->widgetRepository->deleteBy([
                'widget_id' => Str::studly($this->getWidget()) . 'Widget',
                'theme'     => setting('theme'),
            ]);

            $this->info('Widget "' . $this->getWidget() . '" has been deleted.');
        } catch (Exception $exception) {
            $this->info($exception->getMessage());
        }

        return true;
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
