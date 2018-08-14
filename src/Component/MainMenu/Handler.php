<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 14.08.2018
 * Time: 14:50
 */

namespace Aplab\AplabAdminBundle\Component\MainMenu;


class Handler extends Action
{
    /**
     * @var string
     */
    private $handler;

    /**
     * @var array
     */
    private $parameters;

    /**
     * @var string
     */
    private $id;

    /**
     * Handler constructor.
     * @param string $id
     * @param string $handler
     * @param array|null $parameters
     * @throws Exception
     */
    public function __construct(string $id, string $handler, ?array $parameters = null)
    {
        $this->id = $id;
        $this->handler = $handler;
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
    public function getHandler(): string
    {
        return $this->handler;
    }

    /**
     * @param string $handler
     * @return Handler
     */
    public function setHandler(string $handler): Handler
    {
        $this->handler = $handler;
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
     * @return Handler
     */
    public function setParameters(array $parameters): Handler
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
     * @return Handler|null
     */
    public static function getInstance(string $id)
    {
        return static::$instances[$id] ?? null;
    }

    /**
     * @param self $instance
     * @throws Exception
     */
    private static function registerInstance(Handler $instance)
    {
        $id = $instance->getId();
        if (array_key_exists($id, static::$instances)) {
            throw new Exception('Duplicate id: ' . $id);
        }
        static::$instances[$id] = $instance;
    }
}