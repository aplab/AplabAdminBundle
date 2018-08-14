<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 14.08.2018
 * Time: 14:54
 */

namespace Aplab\AplabAdminBundle\Component\MainMenu;


use http\Exception\RuntimeException;

/**
 * Class Icon
 * @package Aplab\AplabAdminBundle\Component\MainMenu
 */
class Icon
{
    /**
     * Unique ID
     * @var string
     */
    protected $id;

    /**
     * Icon string, e.g. "fas fa-users" (without quotes)
     * @var string
     */
    protected $icon;

    /**
     * Color CSS value, e.g. "#FFFFFF" or rgba(...) (without quotes)
     * @var string
     */
    protected $color;

    /**
     * @var static[]
     */
    private static $instances = [];

    /**
     * @param string $id
     * @return Icon|null
     */
    public static function getInstance(string $id)
    {
        return static::$instances[$id] ?? null;
    }

    /**
     * @param self $instance
     * @throws Exception
     */
    private static function registerInstance(Icon $instance)
    {
        $id = $instance->getId();
        if (array_key_exists($id, static::$instances)) {
            throw new Exception('Duplicate id: ' . $id);
        }
        static::$instances[$id] = $instance;
    }

    /**
     * Icon constructor.
     * @param string $id
     * @param string $icon
     * @param null|string $color
     * @throws Exception
     */
    public function __construct(string $id, string $icon, ?string $color)
    {
        $this->id = $id;
        $this->icon = $icon;
        $this->color = $color;
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
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return void
     */
    public function setId()
    {
        throw new RuntimeException('Readonly property');
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     * @return Icon
     */
    public function setIcon(string $icon): Icon
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     * @return Icon
     */
    public function setColor(string $color): Icon
    {
        $this->color = $color;
        return $this;
    }
}