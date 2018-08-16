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
    protected $items = [];

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
     * @var bool
     */
    protected $disabled;

    /**
     * Additional CSS class
     * @var string
     */
    protected $class;

    /**
     * The target attribute specifies where to open the linked document.
     * Variants: _blank|_self|_parent|_top|framename
     * @var string
     */
    protected $target;

    /**
     * @var Action
     */
    protected $action;

    /**
     * @var Icon[]
     */
    protected $icon = [];

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

    /**
     * @return bool
     */
    public function isDisabled(): bool
    {
        return $this->disabled;
    }

    /**
     * @param bool $disabled
     * @return MenuItem
     */
    public function setDisabled(bool $disabled): MenuItem
    {
        $this->disabled = (bool)$disabled;
        return $this;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @param string $class
     * @return MenuItem
     */
    public function setClass(?string $class): MenuItem
    {
        $this->class = $class;
        return $this;
    }

    /**
     * @return string
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     * @param string $target
     * @return MenuItem
     */
    public function setTarget(?string $target): MenuItem
    {
        $this->target = $target;
        return $this;
    }

    /**
     * @return Action
     */
    public function getAction(): Action
    {
        return $this->action;
    }

    /**
     * @param Action $action
     * @return MenuItem
     */
    public function setAction(Action $action): MenuItem
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @return Icon[]
     */
    public function getIcon(): array
    {
        return $this->icon;
    }

    /**
     * @param Icon $icon
     * @return MenuItem
     */
    public function addIcon(Icon $icon): MenuItem
    {
        $this->icon[] = $icon;
        return $this;
    }

    /**
     * @return $this
     */
    public function clearIcon()
    {
        $this->icon = [];
        return $this;
    }
}