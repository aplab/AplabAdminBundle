<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 14.08.2018
 * Time: 14:52
 */

namespace Aplab\AplabAdminBundle\Component\MainMenu;


class Route extends Action
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $parameters;

    /**
     * @var string
     */
    private $id;

    /**
     * Route constructor.
     * @param string $id
     * @param string $name
     * @param array|null $parameters
     */
    public function __construct(string $id, string $name, ?array $parameters = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->parameters = $parameters;
    }
}