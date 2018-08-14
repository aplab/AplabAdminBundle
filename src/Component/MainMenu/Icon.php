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
     * The order of sorting in the case of stacked several icons.
     * @var int
     */
    protected $order;

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
     * Icon constructor.
     * @param string $id
     * @param string $icon
     * @param int $order
     * @param null|string $color
     * @throws Exception
     */
    public function __construct(string $id, string $icon, int $order, ?string $color)
    {
        if (array_key_exists($id, static::$instances)) {
            throw new Exception('Icon id already exists: ' . $id);
        }
        $this->id = $id;
        $this->icon = $icon;
        $this->order = $order;
        $this->color = $color;
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
     * @noinspection PhpUnusedParameterInspection
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

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * @param int $order
     * @return Icon
     */
    public function setOrder(int $order): Icon
    {
        $this->order = $order;
        return $this;
    }
}