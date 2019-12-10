<?php

namespace Botble\Base\Http\Controllers;

use App\Console\Kernel;
use Assets;
use Botble\Base\Commands\PluginActivateCommand;
use Botble\Base\Commands\PluginDeactivateCommand;
use Botble\Base\Commands\PluginRemoveCommand;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Base\Supports\SystemManagement;
use Botble\Base\Tables\InfoTable;
use Botble\Base\Commands\ClearLogCommand;
use Botble\Table\TableBuilder;
use Exception;
use File;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;

class SystemController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @throws \Throwable
     */
    public function getInfo(Request $request, TableBuilder $tableBuilder)
    {
        page_title()->setTitle(trans('core/base::system.info.title'));

        Assets::addScriptsDirectly('vendor/core/js/system-info.js')
            ->addStylesDirectly(['vendor/core/css/system-info.css']);

        $composerArray = SystemManagement::getComposerArray();
        $packages = SystemManagement::getPackagesAndDependencies($composerArray['require']);

        $infoTable = $tableBuilder->create(InfoTable::class);

        if ($request->expectsJson()) {
            return $infoTable->renderTable();
        }

        $systemEnv = SystemManagement::getSystemEnv();
        $serverEnv = SystemManagement::getServerEnv();
        $serverExtras = SystemManagement::getServerExtras();
        $systemExtras = SystemManagement::getSystemExtras();
        $extraStats = SystemManagement::getExtraStats();

        return view('core/base::system.info', compact(
            'packages',
            'infoTable',
            'systemEnv',
            'serverEnv',
            'extraStats',
            'serverExtras',
            'systemExtras'
        ));
    }

    /**
     * Show all plugins in system
     *
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getListPlugins()
    {
        page_title()->setTitle(trans('core/base::system.plugins'));

        if (File::exists(plugin_path('.DS_Store'))) {
            File::delete(plugin_path('.DS_Store'));
        }

        $plugins = scan_folder(plugin_path());
        foreach ($plugins as $plugin) {
            if (File::exists(plugin_path($plugin . '/.DS_Store'))) {
                File::delete(plugin_path($plugin . '/.DS_Store'));
            }
        }

        Assets::addScriptsDirectly('vendor/core/js/plugin.js');

        $list = [];

        $plugins = scan_folder(plugin_path());
        if (!empty($plugins)) {
            $installed = get_active_plugins();
            foreach ($plugins as $plugin) {
                $plugin_path = plugin_path($plugin);
                if (!File::isDirectory($plugin_path) || !File::exists($plugin_path . '/plugin.json')) {
                    continue;
                }

                $content = get_file_data($plugin_path . '/plugin.json');
                if (!empty($content)) {
                    if (!in_array($plugin, $installed)) {
                        $content['status'] = 0;
                    } else {
                        $content['status'] = 1;
                    }

                    $content['path'] = $plugin;
                    $content['image'] = null;
                    if (File::exists($plugin_path . '/screenshot.png')) {
                        $content['image'] = base64_encode(File::get($plugin_path . '/screenshot.png'));
                    }
                    $list[] = (object)$content;
                }
            }
        }

        return view('core/base::plugins.list', compact('list'));
    }

    /**
     * Activate or Deactivate plugin
     *
     * @param Request $request
     * @param BaseHttpResponse $response
     * @param Kernel $kernel
     * @param PluginActivateCommand $pluginActivateCommand
     * @param PluginDeactivateCommand $pluginDeactivateCommand
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     *
     */
    public function getChangePluginStatus(
        Request $request,
        BaseHttpResponse $response,
        Kernel $kernel,
        PluginActivateCommand $pluginActivateCommand,
        PluginDeactivateCommand $pluginDeactivateCommand
    )
    {
        $plugin = strtolower($request->input('alias'));

        $content = get_file_data(plugin_path($plugin . '/plugin.json'));
        if (!empty($content)) {

            try {
                $activated_plugins = get_active_plugins();
                if (!in_array($plugin, $activated_plugins)) {
                    if (!empty(Arr::get($content, 'require'))) {
                        $count_required_plugins = count(array_intersect($content['require'], $activated_plugins));
                        $valid = $count_required_plugins == count($content['require']);
                        if (!$valid) {
                            return $response
                                ->setError()
                                ->setMessage(trans('core/base::system.missing_required_plugins', [
                                    'plugins' => implode(',', $content['require']),
                                ]));
                        }
                    }

                    $kernel->call($pluginActivateCommand->getName(), ['name' => $plugin]);
                } else {
                    $kernel->call($pluginDeactivateCommand->getName(), ['name' => $plugin]);
                }

                return $response->setMessage(trans('core/base::system.update_plugin_status_success'));
            } catch (Exception $ex) {
                info($ex->getMessage());
                return $response
                    ->setError()
                    ->setMessage($ex->getMessage());
            }
        }

        return $response
            ->setError()
            ->setMessage(trans('core/base::system.invalid_plugin'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function getCacheManagement()
    {
        page_title()->setTitle(trans('core/base::cache.cache_management'));

        Assets::addScriptsDirectly('vendor/core/js/cache.js');

        return view('core/base::system.cache');
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @param Kernel $kernel
     * @param ClearLogCommand $clearLogCommand
     * @return BaseHttpResponse
     *
     */
    public function postClearCache(
        Request $request,
        BaseHttpResponse $response,
        Kernel $kernel,
        ClearLogCommand $clearLogCommand
    )
    {
        switch ($request->input('type')) {
            case 'clear_cms_cache':
                $kernel->call('cache:clear');
                break;
            case 'refresh_compiled_views':
                $kernel->call('view:clear');
                break;
            case 'clear_config_cache':
                $kernel->call('config:clear');
                break;
            case 'clear_route_cache':
                $kernel->call('route:clear');
                break;
            case 'clear_log':
                $kernel->call($clearLogCommand->getName());
                break;
        }

        return $response->setMessage(trans('core/base::cache.commands.' . $request->input('type') . '.success_msg'));
    }

    /**
     * Remove plugin
     *
     * @param Request $request
     * @param BaseHttpResponse $response
     * @param Kernel $kernel
     * @param PluginRemoveCommand $pluginRemoveCommand
     * @return mixed
     *
     */
    public function postRemovePlugin(
        Request $request,
        BaseHttpResponse $response,
        Kernel $kernel,
        PluginRemoveCommand $pluginRemoveCommand
    )
    {
        $plugin = strtolower($request->input('plugin'));

        if (in_array($plugin, scan_folder(plugin_path()))) {
            try {
                $kernel->call($pluginRemoveCommand->getName(), ['name' => $plugin, '--force' => true]);
                return $response->setMessage(trans('core/base::system.remove_plugin_success'));
            } catch (Exception $ex) {
                return $response
                    ->setError()
                    ->setMessage($ex->getMessage());
            }
        }

        return $response
            ->setError()
            ->setMessage(trans('core/base::system.invalid_plugin'));
    }
}
