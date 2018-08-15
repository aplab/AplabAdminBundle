<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 14.08.2018
 * Time: 13:51
 */

namespace Aplab\AplabAdminBundle\Component\Menu;


class MenuItem
{
    /**
     * @var static[]
     */
    protected static $instances = [];

    /**
     * @var static[]
     */
    protected $items;

    /**
     * @return static[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param self $item
     * @return static
     */
    public function addItem(MenuItem $item)
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * @var string
     */
    protected $id;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function setId()
    {
        throw new Exception('Readonly property');
    }

    /**
     * MenuItem constructor.
     * @param string $id
     * @throws Exception
     */
    public function __construct(string $id)
    {
        $this->id = $id;
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
     * @param string $id
     * @return static|null
     */
    public static function getInstance(string $id)
    {
        return static::$instances[$id] ?? null;
    }

    /**
     * @param self $instance
     * @throws Exception
     */
    private static function registerInstance(MenuItem $instance)
    {
        $id = $instance->getId();
        if (array_key_exists($id, static::$instances)) {
            throw new Exception('Duplicate id: ' . $id);
        }
        static::$instances[$id] = $instance;
    }
}