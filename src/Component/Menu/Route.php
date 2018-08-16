<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 14.08.2018
 * Time: 14:52
 */

namespace Aplab\AplabAdminBundle\Component\Menu;

/**
 * Class Route
 * @package Aplab\AplabAdminBundle\Component\Menu
 */
class Route extends Action
{
    /**
     * @var string
     */
    private $route;

    /**
     * @var array
     */
    private $parameters;

    /**
     * Route constructor.
     * @param string $route
     * @param array $parameters
     */
    public function __construct(string $route, array $parameters = [])
    {
        $this->route = $route;
        $this->parameters = $parameters;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @param string $route
     * @return Route
     */
    public function setRoute(string $route): Route
    {
        $this->route = $route;
        return $this;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     * @return Route
     */
    public function setParameters(array $parameters): Route
    {
        $this->parameters = $parameters;
        return $this;
    }
}