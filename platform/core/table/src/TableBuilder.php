<?php

namespace Botble\Table;

use Illuminate\Contracts\Container\Container;
use InvalidArgumentException;

class TableBuilder
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * TableBuilder constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $tableClass
     * @return \Botble\Table\Abstracts\TableAbstract
     *
     */
    public function create($tableClass)
    {
        if (!class_exists($tableClass)) {
            throw new InvalidArgumentException(
                'Table class with name ' . $tableClass . ' does not exist.'
            );
        }

        return $this->container->make($tableClass);
    }
}