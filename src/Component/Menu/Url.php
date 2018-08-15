<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 14.08.2018
 * Time: 14:52
 */

namespace Aplab\AplabAdminBundle\Component\Menu;


class Url extends Action
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var array
     */
    private $parameters;

    /**
     * @var string
     */
    private $id;

    /**
     * Url constructor.
     * @param string $id
     * @param string $url
     * @param array|null $parameters
     * @throws Exception
     */
    public function __construct(string $id, string $url)
    {
        $this->id = $id;
        $this->url = $url;
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
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Url
     */
    public function setUrl(string $url): Url
    {
        $this->url = $url;
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
     * @return Url|null
     */
    public static function getInstance(string $id)
    {
        return static::$instances[$id] ?? null;
    }

    /**
     * @param self $instance
     * @throws Exception
     */
    private static function registerInstance(Url $instance)
    {
        $id = $instance->getId();
        if (array_key_exists($id, static::$instances)) {
            throw new Exception('Duplicate id: ' . $id);
        }
        static::$instances[$id] = $instance;
    }
}