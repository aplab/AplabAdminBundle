<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 02.08.2018
 * Time: 10:46
 */

namespace Aplab\AplabAdminBundle\Component\DataTableRepresentation;


use Aplab\AplabAdminBundle\Component\DataTableRepresentation\CellType\CellTypeFactory;
use Aplab\AplabAdminBundle\Component\DataTableRepresentation\CellType\CellTypeInterface;
use Aplab\AplabAdminBundle\Component\ModuleMetadata\Cell;
use Aplab\AplabAdminBundle\Component\ModuleMetadata\Options;
use Aplab\AplabAdminBundle\Component\ModuleMetadata\Property;

class DataTableCell
{
    /**
     * @var string
     */
    private $propertyName;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $order;

    /**
     * @var CellTypeInterface
     */
    private $type;

    /**
     * @var Options
     */
    private $options;

    /**
     * DataTableCell constructor.
     * @param \ReflectionProperty $property
     * @param Property $property_metadata
     * @param Cell $cell_metadata
     * @param CellTypeFactory $factory
     */
    public function __construct(\ReflectionProperty $property, Property $property_metadata, Cell $cell_metadata, CellTypeFactory $factory)
    {
        $this->propertyName = $property->getName();
        $this->width = $cell_metadata->getWidth();
        $this->order = $cell_metadata->getOrder();
        $this->type = $factory->create($cell_metadata->getType());
        $this->options = $cell_metadata->getOptions();
    }

    /**
     * @return string
     */
    public function getPropertyName(): string
    {
        return $this->propertyName;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * @return CellTypeInterface
     */
    public function getType(): CellTypeInterface
    {
        return $this->type;
    }


}