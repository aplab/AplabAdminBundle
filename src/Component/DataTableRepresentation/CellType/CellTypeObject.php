<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 02.08.2018
 * Time: 10:52
 */

namespace Aplab\AplabAdminBundle\Component\DataTableRepresentation\CellType;


class CellTypeObject extends CellTypeAbstract
{
    /**
     * @param object $entity
     * @return mixed
     */
    public function getValue($entity)
    {
        $value = parent::getValue($entity);
        if ($value) {
            return $value->getName();
        }
        return null;
    }
}