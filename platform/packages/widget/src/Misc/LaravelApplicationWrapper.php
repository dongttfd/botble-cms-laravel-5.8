<?php

namespace Botble\Widget\Misc;

use Botble\Widget\Contracts\ApplicationWrapperContract;
use Illuminate\Container\Container;

class LaravelApplicationWrapper implements ApplicationWrapperContract
{

    /**
     * @var \App
     */
    protected $app;

    /**
     * Constructor.
     *
     */
    public function __construct()
    {
        $this->app = Container::getInstance();
    }

    /**
     * Wrapper around app()->call().
     *
     * @param $method
     * @param array $params
     * @return mixed
     *
     */
    public function call($method, $params = [])
    {
        return $this->app->call($method, $params);
    }

    /**
     * Get the specified configuration value.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function config($key, $default = null)
    {
        return $this->app->make('config')->get($key, $default);
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->app->getNamespace();
    }

    /**
     * Wrapper around app()->make().
     *
     * @param string $abstract
     * @param array $parameters
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function make($abstract, array $parameters = [])
    {
        return $this->app->make($abstract, $parameters);
    }
}
