<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 14.08.2018
 * Time: 13:48
 */

namespace Aplab\AplabAdminBundle\Component\MainMenu;


class MainMenu
{
    protected static $instances = [];

    /**
     * @var MenuItem[]
     */
    protected $items;

    /**
     * @var string
     */
    protected $instanceName;

    public function __construct(string $instance_name)
    {
        $this->instanceName = $instance_name;
    }
}