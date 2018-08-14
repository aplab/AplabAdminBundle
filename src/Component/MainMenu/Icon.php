<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 14.08.2018
 * Time: 14:54
 */

namespace Aplab\AplabAdminBundle\Component\MainMenu;


use http\Exception\RuntimeException;

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
     * Icon constructor.
     * @param string $icon
     * @param string $id
     * @param int $order
     * @param string $color
     */
    public function __construct($icon, $id, $order, $color)
    {
        $this->icon = $icon;
        $this->id = $id;
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
     * @param string $id
     * @return void
     */
    public function setId(string $id)
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