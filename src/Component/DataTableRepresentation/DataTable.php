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
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Tests\Compiler\C;

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
     * DataTable constructor.
     * @param \ReflectionClass $erc
     * @param DataTableRepresentation $dtr
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \ReflectionException
     */
    public function __construct(\ReflectionClass $erc, DataTableRepresentation $dtr)
    {
        $this->entityReflectionClass = $erc;
        $this->entityClassName = $this->entityReflectionClass->getName();
        $this->entityManager = $dtr->getEntityManager();
        $this->moduleMetadata = $dtr->getModuleMetadataRepository()->getMetadata($this->entityClassName);
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
                $this->cell[] = new DataTableCell($property, $property_metadata, $cell_metadata, $f);
            }
        }
        usort($this->cell, function (DataTableCell $a, DataTableCell $b) {
            return $a->getOrder() <=> $b->getOrder();
        });
    }
}