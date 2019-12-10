<?php

namespace Botble\Theme;

use Botble\Theme\Contracts\Theme as ThemeContract;
use Botble\Theme\Exceptions\UnknownPartialFileException;
use Botble\Theme\Exceptions\UnknownThemeException;
use Closure;
use Exception;
use Illuminate\Config\Repository;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\View\Factory;
use SeoHelper;
use Symfony\Component\HttpFoundation\Cookie;

class Theme implements ThemeContract
{
    /**
     * Theme namespace.
     */
    public static $namespace = 'theme';

    /**
     * Repository config.
     *
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * Event dispatcher.
     *
     * @var \Illuminate\Events\Dispatcher
     */
    protected $events;

    /**
     * Theme configuration.
     *
     * @var mixed
     */
    protected $themeConfig;

    /**
     * View.
     *
     * @var \Illuminate\View\Factory
     */
    protected $view;

    /**
     * Asset.
     *
     * @var \Botble\Theme\Asset | AssetContainer
     */
    protected $asset;

    /**
     * Filesystem.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The name of theme.
     *
     * @var string
     */
    protected $theme;

    /**
     * The name of layout.
     *
     * @var string
     */
    protected $layout;

    /**
     * Content dot path.
     *
     * @var string
     */
    protected $content;

    /**
     * Regions in the theme.
     *
     * @var array
     */
    protected $regions = [];

    /**
     * Content arguments.
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * Data bindings.
     *
     * @var array
     */
    protected $bindings = [];

    /**
     * Cookie var.
     *
     * @var Cookie
     */
    protected $cookie;

    /**
     * Breadcrumb.
     *
     * @var \Botble\Theme\Breadcrumb
     */
    protected $breadcrumb;

    /**
     * Theme constructor.
     * @param Repository $config
     * @param Dispatcher $events
     * @param Factory $view
     * @param Asset $asset
     * @param Filesystem $files
     * @param \Botble\Theme\Breadcrumb $breadcrumb
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function __construct(
        Repository $config,
        Dispatcher $events,
        Factory $view,
        Asset $asset,
        Filesystem $files,
        Breadcrumb $breadcrumb
    )
    {
        $this->config = $config;
        $this->events = $events;
        $this->view = $view;
        $this->asset = $asset;
        $this->files = $files;

        $this->breadcrumb = $breadcrumb;

        self::uses(setting('theme'))->layout(setting('layout', 'default'));

        SeoHelper::meta()->setGoogle(setting('google_analytics'))
            ->addWebmaster('google', setting('google_site_verification'));
    }

    /**
     * Return breadcrumb instance.
     *
     * @return \Botble\Theme\Breadcrumb
     */
    public function breadcrumb()
    {
        return $this->breadcrumb;
    }

    /**
     * Get current theme name.
     *
     * @return string
     */
    public function getThemeName()
    {
        return $this->theme;
    }

    /**
     * Get current layout name.
     *
     * @return string
     */
    public function getLayoutName()
    {
        return $this->layout;
    }

    /**
     * Get theme namespace.
     *
     * @param string $path
     *
     * @return string
     */
    public function getThemeNamespace($path = '')
    {
        // Namespace relate with the theme name.
        $namespace = static::$namespace . '.' . $this->getThemeName();

        if ($path != false) {
            return $namespace . '::' . $path;
        }

        return $namespace;
    }

    /**
     * Check theme exists.
     *
     * @param  string $theme
     * @return boolean
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function exists($theme)
    {
        $path = platform_path($this->path($theme)) . '/';

        return is_dir($path);
    }

    /**
     * Get theme config.
     *
     * @param  string $key
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getConfig($key = null)
    {
        // Main package config.
        if (!$this->themeConfig) {
            $this->themeConfig = $this->config->get('packages.theme.general');
        }

        // Config inside a public theme.
        // This config having buffer by array object.
        if ($this->theme && !isset($this->themeConfig['themes'][$this->theme])) {
            $this->themeConfig['themes'][$this->theme] = [];

            // Require public theme config.
            $minorConfigPath = theme_path($this->theme . '/config.php');

            $this->themeConfig['themes'][$this->theme] = $this->files->getRequire($minorConfigPath);
        }

        // Evaluate theme config.
        $this->themeConfig = $this->evaluateConfig($this->themeConfig);

        return empty($key) ? $this->themeConfig : Arr::get($this->themeConfig, $key);
    }

    /**
     * Evaluate config.
     *
     * Config minor is at public folder [theme]/config.php,
     * they can be override package config.
     *
     * @param  mixed $config
     * @return mixed
     */
    protected function evaluateConfig($config)
    {
        if (!isset($config['themes'][$this->theme])) {
            return $config;
        }

        // Config inside a public theme.
        $minorConfig = $config['themes'][$this->theme];

        // Before event is special case, It's combination.
        if (isset($minorConfig['events']['before'])) {
            $minorConfig['events']['appendBefore'] = $minorConfig['events']['before'];
            unset($minorConfig['events']['before']);
        }

        // Merge two config into one.
        $config = array_replace_recursive($config, $minorConfig);

        // Reset theme config.
        $config['themes'][$this->theme] = [];

        return $config;
    }

    /**
     * Add location path to look up.
     *
     * @param string $location
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function addPathLocation($location)
    {
        // First path is in the selected theme.
        $hints[] = platform_path($location);

        // This is nice feature to use inherit from another.
        if ($this->getConfig('inherit')) {
            // Inherit from theme name.
            $inherit = $this->getConfig('inherit');

            // Inherit theme path.
            $inheritPath = platform_path($this->path($inherit));

            if ($this->files->isDirectory($inheritPath)) {
                array_push($hints, $inheritPath);
            }
        }

        // Add namespace with hinting paths.
        $this->view->addNamespace($this->getThemeNamespace(), $hints);
    }

    /**
     * Fire event to config listener.
     *
     * @param  string $event
     * @param  mixed $args
     * @return void
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function fire($event, $args)
    {
        $onEvent = $this->getConfig('events.' . $event);

        if ($onEvent instanceof Closure) {
            $onEvent($args);
        }
    }

    /**
     * Set up a theme name.
     *
     * @param  string $theme
     * @throws \Botble\Theme\Exceptions\UnknownThemeException
     * @return Theme
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function theme($theme = null)
    {
        // If theme name is not set, so use default from config.
        if (check_database_connection() && $theme != false) {
            $this->theme = $theme;
        }

        // Is theme ready?
        if (!$this->exists($theme)) {
            throw new UnknownThemeException('Theme [' . $theme . '] not found.');
        }

        // Add location to look up view.
        $this->addPathLocation($this->path());

        // Fire event before set up a theme.
        $this->fire('before', $this);

        // Before from a public theme config.
        $this->fire('appendBefore', $this);

        // Add asset path to asset container.
        $this->asset->addPath($this->path() . '/' . $this->getConfig('containerDir.asset'));

        return $this;
    }

    /**
     * Alias of theme method.
     *
     * @param  string $theme
     * @return Theme
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function uses($theme = null)
    {
        return $this->theme($theme);
    }

    /**
     * Set up a layout name.
     *
     * @param  string $layout
     * @return Theme
     */
    public function layout($layout)
    {
        // If layout name is not set, so use default from config.
        if ($layout != false) {
            $this->layout = $layout;
        }

        return $this;
    }

    /**
     * Get theme path.
     *
     * @param  string $forceThemeName
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function path($forceThemeName = null)
    {
        $themeDir = $this->getConfig('themeDir');

        $theme = $this->theme;

        if ($forceThemeName != false) {
            $theme = $forceThemeName;
        }

        return $themeDir . '/' . $theme;
    }

    /**
     * Set a place to regions.
     *
     * @param  string $region
     * @param  string $value
     * @return Theme
     */
    public function set($region, $value)
    {
        // Content is reserve region for render sub-view.
        if ($region != 'content') {
            $this->regions[$region] = $value;
        }

        return $this;
    }

    /**
     * Append a place to existing region.
     *
     * @param  string $region
     * @param  string $value
     * @return Theme
     */
    public function append($region, $value)
    {
        return $this->appendOrPrepend($region, $value, 'append');
    }

    /**
     * Prepend a place to existing region.
     *
     * @param  string $region
     * @param  string $value
     * @return Theme
     */
    public function prepend($region, $value)
    {
        return $this->appendOrPrepend($region, $value, 'prepend');
    }

    /**
     * Append or prepend existing region.
     *
     * @param  string $region
     * @param  string $value
     * @param  string $type
     * @return Theme
     */
    protected function appendOrPrepend($region, $value, $type = 'append')
    {
        // If region not found, create a new region.
        if (isset($this->regions[$region])) {
            switch ($type) {
                case 'prepend':
                    $this->regions[$region] = $value . $this->regions[$region];
                    break;
                case 'append':
                    $this->regions[$region] .= $value;
                    break;
            }
        } else {
            $this->set($region, $value);
        }

        return $this;
    }

    /**
     * Binding data to view.
     *
     * @param  string $variable
     * @param  mixed $callback
     * @return mixed
     */
    public function bind($variable, $callback = null)
    {
        $name = 'bind.' . $variable;

        // If callback pass, so put in a queue.
        if (!empty($callback)) {
            // Preparing callback in to queues.
            $this->events->listen($name, function () use ($callback) {
                return ($callback instanceof Closure) ? $callback() : $callback;
            });
        }

        // Passing variable to closure.
        $_events =& $this->events;
        $_bindings =& $this->bindings;

        // Buffer processes to save request.
        return Arr::get($this->bindings, $name, function () use (&$_events, &$_bindings, $name) {
            $response = current($_events->fire($name));
            Arr::set($_bindings, $name, $response);
            return $response;
        });
    }

    /**
     * Check having binded data.
     *
     * @param  string $variable
     * @return boolean
     */
    public function binded($variable)
    {
        $name = 'bind.' . $variable;

        return $this->events->hasListeners($name);
    }

    /**
     * Assign data across all views.
     *
     * @param  mixed $key
     * @param  mixed $value
     * @return mixed
     */
    public function share($key, $value)
    {
        return $this->view->share($key, $value);
    }

    /**
     * Set up a partial.
     *
     * @param  string $view
     * @param  array $args
     * @throws \Botble\Theme\Exceptions\UnknownPartialFileException
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function partial($view, $args = [])
    {
        $partialDir = $this->getThemeNamespace($this->getConfig('containerDir.partial'));

        return $this->loadPartial($view, $partialDir, $args);
    }

    /**
     * The same as "partial", but having prefix layout.
     *
     * @param  string $view
     * @param  array $args
     * @throws \Botble\Theme\Exceptions\UnknownPartialFileException
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function partialWithLayout($view, $args = [])
    {
        $view = $this->getLayoutName() . '.' . $view;

        return $this->partial($view, $args);
    }

    /**
     * Load a partial
     *
     * @param  string $view
     * @param  string $partialDir
     * @param  array $args
     * @throws \Botble\Theme\Exceptions\UnknownPartialFileException
     * @return mixed
     */
    public function loadPartial($view, $partialDir, $args)
    {
        $path = $partialDir . '.' . $view;

        if (!$this->view->exists($path)) {
            throw new UnknownPartialFileException('Partial view [' . $view . '] not found.');
        }

        $partial = $this->view->make($path, $args)->render();
        $this->regions[$view] = $partial;

        return $this->regions[$view];
    }

    /**
     * Watch and set up a partial from anywhere.
     *
     * This method will first try to load the partial from current theme. If partial
     * is not found in theme then it loads it from app (i.e. app/views/partials)
     *
     * @param  string $view
     * @param  array $args
     * @throws \Botble\Theme\Exceptions\UnknownPartialFileException
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function watchPartial($view, $args = [])
    {
        try {
            return $this->partial($view, $args);
        } catch (UnknownPartialFileException $e) {
            $partialDir = $this->getConfig('containerDir.partial');
            return $this->loadPartial($view, $partialDir, $args);
        }
    }

    /**
     * Hook a partial before rendering.
     *
     * @param  mixed $view
     * @param  closure $callback
     * @param string $layout
     * @return void
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function partialComposer($view, $callback, $layout = null)
    {
        $partialDir = $this->getConfig('containerDir.partial');

        if (!is_array($view)) {
            $view = [$view];
        }

        // Partial path with namespace.
        $path = $this->getThemeNamespace($partialDir);

        // This code support partialWithLayout.
        if (!empty($layout)) {
            $path = $path . '.' . $layout;
        }

        $view = array_map(function ($item) use ($path) {
            return $path . '.' . $item;
        }, $view);

        $this->view->composer($view, $callback);
    }

    /**
     * Hook a partial before rendering.
     *
     * @param  mixed $view
     * @param  closure $callback
     * @param string $layout
     * @return void
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function composer($view, $callback, $layout = null)
    {
        $partialDir = $this->getConfig('containerDir.view');

        if (!is_array($view)) {
            $view = [$view];
        }

        // Partial path with namespace.
        $path = $this->getThemeNamespace($partialDir);

        // This code support partialWithLayout.
        if (!empty($layout)) {
            $path = $path . '.' . $layout;
        }

        $view = array_map(function ($item) use ($path) {
            return $path . '.' . $item;
        }, $view);

        $this->view->composer($view, $callback);
    }

    /**
     * Check region exists.
     *
     * @param  string $region
     * @return boolean
     */
    public function has($region)
    {
        return (boolean)isset($this->regions[$region]);
    }

    /**
     * Render a region.
     *
     * @param  string $region
     * @param  mixed $default
     * @return string
     */
    public function get($region, $default = null)
    {
        if ($this->has($region)) {
            return $this->regions[$region];
        }

        return $default ? $default : '';
    }

    /**
     * Render a region.
     *
     * @param  string $region
     * @param  mixed $default
     * @return string
     */
    public function place($region, $default = null)
    {
        return $this->get($region, $default);
    }

    /**
     * Place content in sub-view.
     *
     * @return string
     */
    public function content()
    {
        return $this->regions['content'];
    }

    /**
     * Return asset instance.
     *
     * @return Asset|AssetContainer
     */
    public function asset()
    {
        return $this->asset;
    }

    /**
     * Set up a content to template.
     *
     * @param  string $view
     * @param  array $args
     * @return Theme
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function setUpContent($view, $args = [])
    {

        // Fire event global assets.
        $this->fire('asset', $this->asset);

        // Fire event before render theme.
        $this->fire('beforeRenderTheme', $this);

        // Fire event before render layout.
        $this->fire('beforeRenderLayout.' . $this->layout, $this);

        // Keeping arguments.
        $this->arguments = $args;

        $content = $this->view->make($view, $args)->render();

        // View path of content.
        $this->content = $view;

        // Set up a content regional.
        $this->regions['content'] = $content;

        return $this;
    }

    /**
     * Set up a content to template.
     *
     * @param  string $view
     * @param  array $args
     * @return Theme
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws Exception
     */
    public function of($view, $args = [])
    {
        // Fire event global assets.
        $this->fire('asset', $this->asset);
        // Fire event before render theme.
        $this->fire('beforeRenderTheme', $this);
        // Fire event before render layout.
        $this->fire('beforeRenderLayout.' . $this->layout, $this);
        // Keeping arguments.
        $this->arguments = $args;

        $content = $this->view->make($view, $args)->render();
        // View path of content.
        $this->content = $view;
        // Set up a content regional.
        $this->regions['content'] = $content;
        return $this;
    }

    /**
     * The same as "of", but having prefix layout.
     *
     * @param  string $view
     * @param  array $args
     * @param  string $type
     * @return Theme
     * @throws \Exception
     */
    public function ofWithLayout($view, $args = [], $type = null)
    {
        $view = $this->getLayoutName() . '.' . $view;
        return $this->of($view, $args, $type);
    }

    /**
     * Container view.
     *
     * Using a container module view inside a theme, this is
     * useful when you separate a view inside a theme.
     *
     * @param  string $view
     * @param  array $args
     * @return Theme
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function scope($view, $args = [], $default = null)
    {
        $viewDir = $this->getConfig('containerDir.view');

        // Add namespace to find in a theme path.
        $path = $this->getThemeNamespace($viewDir . '.' . $view);

        if ($this->view->exists($path)) {
            return $this->setUpContent($path, $args);
        }

        if (!empty($default)) {
            return $this->of($default, $args);
        }

        $this->handleViewNotFound($path);
    }

    /**
     * Load subview from direct path.
     *
     * @param  string $view
     * @param  array $args
     * @return Theme
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function load($view, $args = [])
    {
        $view = ltrim($view, '/');

        $segments = explode('/', str_replace('.', '/', $view));

        // Pop file from segments.
        $view = array_pop($segments);

        // Custom directory path.
        $pathOfView = app('path.base') . '/' . implode('/', $segments);

        // Add temporary path with a hint type.
        $this->view->addNamespace('custom', $pathOfView);

        return $this->setUpContent('custom::' . $view, $args);
    }

    /**
     * Get all arguments assigned to content.
     *
     * @return mixed
     */
    public function getContentArguments()
    {
        return $this->arguments;
    }

    /**
     * Get a argument assigned to content.
     *
     * @param  string $key
     * @param null $default
     * @return mixed
     */
    public function getContentArgument($key, $default = null)
    {
        return Arr::get($this->arguments, $key, $default);
    }

    /**
     * Checking content argument existing.
     *
     * @param  string $key
     * @return boolean
     */
    public function hasContentArgument($key)
    {
        return (bool)isset($this->arguments[$key]);
    }

    /**
     * Find view location.
     *
     * @param  boolean $real_path
     * @return string
     */
    public function location($real_path = false)
    {
        if ($this->view->exists($this->content)) {
            return ($real_path) ? $this->view->getFinder()->find($this->content) : $this->content;
        }
        return null;
    }

    /**
     * Return a template with content.
     *
     * @param  integer $statusCode
     * @throws \Botble\Theme\Exceptions\UnknownLayoutFileException
     * @return \Illuminate\Http\Response | Response | \Response
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function render($statusCode = 200)
    {
        // Fire the event before render.
        $this->fire('after', $this);

        // Flush asset that need to serve.
        $this->asset->flush();

        // Layout directory.
        $layoutDir = $this->getConfig('containerDir.layout');

        $path = $this->getThemeNamespace($layoutDir . '.' . $this->layout);

        if (!$this->view->exists($path)) {
            $this->handleViewNotFound($path);
        }

        $content = $this->view->make($path)->render();

        // Append status code to view.
        $content = new Response($content, $statusCode);

        // Having cookie set.
        if ($this->cookie) {
            $content->withCookie($this->cookie);
        }

        $content->withHeaders([
            'Author'      => 'Sang Nguyen (sangnguyenplus@gmail.com)',
            'Author-Team' => 'https://botble.com',
            'CMS'         => 'Botble CMS',
            'CMS-Version' => get_cms_version(),
        ]);

        return $content;
    }

    /**
     * @return string
     *
     */
    public function header()
    {
        return $this->view->make('packages/theme::partials.header')->render();
    }

    /**
     * @return string
     *
     */
    public function footer()
    {
        return $this->view->make('packages/theme::partials.footer')->render();
    }

    /**
     * Magic method for set, prepend, append, has, get.
     *
     * @param  string $method
     * @param  array $parameters
     * @return mixed
     */
    public function __call($method, $parameters = [])
    {
        $callable = preg_split('|[A-Z]|', $method);

        if (in_array($callable[0], ['set', 'prepend', 'append', 'has', 'get'])) {
            $value = lcfirst(preg_replace('|^' . $callable[0] . '|', '', $method));
            array_unshift($parameters, $value);

            return call_user_func_array([$this, $callable[0]], $parameters);
        }

        trigger_error('Call to undefined method ' . __CLASS__ . '::' . $method . '()', E_USER_ERROR);
        return false;
    }

    /**
     *
     * @param $path
     */
    protected function handleViewNotFound($path)
    {
        if (app()->isLocal()) {
            dd('Theme is not support this view, please create file ' . theme_path() . '/' . str_replace($this->getThemeNamespace(), $this->getThemeName(), str_replace('::', '/', str_replace('.', '/', $path))) . '.blade.php" to render this page!');
        } else {
            abort(404);
        }
    }
}
