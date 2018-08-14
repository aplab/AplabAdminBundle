<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 14.08.2018
 * Time: 13:48
 */

namespace Aplab\AplabAdminBundle\Component\Menu;


class Menu
{
    /**
     * @var static[]
     */
    protected static $instances = [];

    /**
     * @var MenuItem[]
     */
    protected $items;

    /**
     * @return MenuItem[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param MenuItem $item
     * @return Menu
     */
    public function addItem(MenuItem $item)
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * @var string
     */
    protected $instanceName;

    /**
     * @return string
     */
    public function getInstanceName()
    {
        return $this->instanceName;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function setInstanceName()
    {
        throw new Exception('Readonly property');
    }

    /**
     * MainMenu constructor.
     * @param string $instance_name
     * @throws Exception
     */
    public function __construct(string $instance_name)
    {
        $this->instanceName = $instance_name;
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
     * @param string $instance_name
     * @return Menu|null
     */
    public static function getInstance(string $instance_name)
    {
        return static::$instances[$instance_name] ?? null;
    }

    /**
     * @param self $instance
     * @throws Exception
     */
    private static function registerInstance(Menu $instance)
    {
        $instanceName = $instance->getInstanceName();
        if (array_key_exists($instanceName, static::$instances)) {
            throw new Exception('Duplicate instanceName: ' . $instanceName);
        }
        static::$instances[$instanceName] = $instance;
    }
}