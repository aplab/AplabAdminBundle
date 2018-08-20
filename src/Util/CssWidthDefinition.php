<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 20.08.2018
 * Time: 22:39
 */

namespace Aplab\AplabAdminBundle\Util;


class CssWidthDefinition
{
    /**
     * @var array
     */
    private $data;

    /**
     * CssWidthDefinition constructor.
     */
    public function __construct()
    {
        $this->data = [];
    }

    /**
     * @param int $width
     * @return CssWidthDefinition
     */
    public function add(int $width): self
    {
        $this->data[$width] = $width;
        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return array_values($this->data);
    }
}