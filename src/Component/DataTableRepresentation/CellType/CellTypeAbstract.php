<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 02.08.2018
 * Time: 10:49
 */

namespace Aplab\AplabAdminBundle\Component\DataTableRepresentation\CellType;


abstract class CellTypeAbstract implements CellTypeInterface
{
    /**
     * @var string
     */
    private $type;

    /**
     * @return string
     */
    public function getType()
    {
        if (is_null($this->type)) {
            $tmp = explode(CellTypeFactory::PREFIX, static::class);
            $this->type = strtolower(end($tmp));
        }
        return $this->type;
    }
}