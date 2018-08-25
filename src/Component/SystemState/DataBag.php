<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 25.08.2018
 * Time: 9:00
 */

namespace Aplab\AplabAdminBundle\Component\SystemState;


class DataBag
{
    /**
     * @var SystemState
     */
    private $owner;

    /**
     * DataBag constructor.
     * @param SystemState $owner
     */
    public function __construct(SystemState $owner)
    {
        $this->owner = $owner;
    }

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param string $name
     * @return mixed|null
     */
    public function __get($name)
    {
        return $this->get($name);
    }

    /**
     * @param string $name
     * @param null $default
     * @return mixed|null
     */
    public function get($name, $default = null)
    {
        return array_key_exists($name, $this->data) ? $this->data[$name] : $default;
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->data)) {
            if ($this->data[$name] === $value) {
                return;
            }
            $this->data[$name] = $value;
            $this->owner->setIsModified();
        } else {
            $this->data[$name] = $value;
            $this->owner->setIsModified();
        }
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return array_key_exists($name, $this->data);
    }

    /**
     * @param $name
     */
    public function __unset($name)
    {
        if (array_key_exists($name, $this->data)) {
            unset($this->data[$name]);
            $this->owner->setIsModified();
        }
    }
}