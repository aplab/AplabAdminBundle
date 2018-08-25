<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 20.08.2018
 * Time: 15:57
 */

namespace Aplab\AplabAdminBundle\Component\DataTableRepresentation;


use Aplab\AplabAdminBundle\Component\DataTableRepresentation\CellType\CellTypeFactory;
use Aplab\AplabAdminBundle\Component\ModuleMetadata\ModuleMetadata;
use Aplab\AplabAdminBundle\Util\CssWidthDefinition;
use Doctrine\ORM\EntityManagerInterface;

class DataTable
{
    /**
     * @var string
     */
    private $entityClassName;

    /**
     * @var \ReflectionClass
     */
    private $entityReflectionClass;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ModuleMetadata
     */
    private $moduleMetadata;

    /**
     * @var DataTableCell[];
     */
    private $cell;

    /**
     * @var CssWidthDefinition
     */
    private $cssWidthDefinition;

    /**
     * @var \Aplab\AplabAdminBundle\Component\SystemState\SystemState
     */
    private $systemState;

    /**
     * DataTable constructor.
     * @param \ReflectionClass $entity_reflection_class
     * @param DataTableRepresentation $data_table_representation
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \ReflectionException
     */
    public function __construct(\ReflectionClass $entity_reflection_class,
                                DataTableRepresentation $data_table_representation)
    {
        $this->entityReflectionClass = $entity_reflection_class;
        $this->entityClassName = $this->entityReflectionClass->getName();
        $this->entityManager = $data_table_representation->getEntityManager();
        $this->moduleMetadata = $data_table_representation->getModuleMetadataRepository()
            ->getMetadata($this->entityClassName);
        $this->cssWidthDefinition = $data_table_representation->getCssWidthDefinition();
        $this->systemState = $data_table_representation->getSystemStateManager()
            ->get()->get($this->entityClassName . __CLASS__);
    }

    /**
     * @return DataTableCell[]
     */
    public function getCell()
    {
        if (is_null($this->cell)) {
            $this->initCell();
        }
        return $this->cell;
    }

    /**
     * Data table cell initialization
     */
    private function initCell(): void
    {
        $f = new CellTypeFactory;
        $this->cell = [];
        $properties = $this->moduleMetadata->getProperties();
        foreach ($properties as $property_name => $property_metadata) {
            $cell_metadata_list = $property_metadata->getCell();
            $property = $this->entityReflectionClass->getProperty($property_name);
            foreach ($cell_metadata_list as $cell_metadata) {
                $this->cssWidthDefinition->add($cell_metadata->getWidth());
                $this->cell[] = new DataTableCell($property, $property_metadata, $cell_metadata, $f);
            }
        }
        usort($this->cell, function (DataTableCell $a, DataTableCell $b) {
            return $a->getOrder() <=> $b->getOrder();
        });
    }

    /**
     * Temporary stub
     * @return object[]
     */
    public function getItems()
    {
        return $this->entityManager->getRepository($this->entityClassName)->findAll();
    }

    /**
     * @var int
     */
    private $count;

    /**
     * @param void
     * @return int
     */
    public function getCount():int
    {
        if (is_null($this->count)) {
            $this->count = $this->entityManager->getRepository($this->entityClassName)->count([]);
        }
        return $this->count;
    }
}