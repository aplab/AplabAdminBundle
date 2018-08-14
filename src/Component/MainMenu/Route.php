<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 14.08.2018
 * Time: 14:52
 */

namespace Aplab\AplabAdminBundle\Component\MainMenu;

/**
 * Class Route
 * @package Aplab\AplabAdminBundle\Component\MainMenu
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
     * @var string
     */
    private $id;

    /**
     * Route constructor.
     * @param string $id
     * @param string $route
     * @param array|null $parameters
     * @throws Exception
     */
    public function __construct(string $id, string $route, int $order, ?array $parameters = null)
    {
        $this->id = $id;
        $this->route = $route;
        $this->parameters = $parameters;
        static::registerInstance($this);
    }

    /**
     * @throws Exception
     */
    public function __wakeup()
    {
        static::registerInstance($this);
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

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return void
     */
    public function setId()
    {
        throw new \RuntimeException('Readonly property');
    }

    /**
     * @var static[]
     */
    private static $instances = [];

    /**
     * @param string $id
     * @return Route|null
     */
    public static function getInstance(string $id)
    {
        return static::$instances[$id] ?? null;
    }

    /**
     * @param self $instance
     * @throws Exception
     */
    private static function registerInstance(Route $instance)
    {
        $id = $instance->getId();
        if (array_key_exists($id, static::$instances)) {
            throw new Exception('Duplicate id: ' . $id);
        }
        static::$instances[$id] = $instance;
    }
}