<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 02.08.2018
 * Time: 10:42
 */

namespace Aplab\AplabAdminBundle\Component\DataTableRepresentation;


use Aplab\AplabAdminBundle\Component\ModuleMetadata\ModuleMetadataRepository;
use Doctrine\ORM\EntityManagerInterface;

class DataTableRepresentation
{
    /**
     * @var ModuleMetadataRepository
     */
    private $moduleMetadataRepository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var \ReflectionClass[]
     */
    private $entityReflectionClass = [];

    /**
     * @var DataTable[]
     */
    private $dataTable = [];

    /**
     * DataTable constructor.
     * @param ModuleMetadataRepository $mmr
     * @param EntityManagerInterface $emi
     */
    public function __construct(ModuleMetadataRepository $mmr, EntityManagerInterface $emi)
    {
        $this->moduleMetadataRepository = $mmr;
        $this->entityManager = $emi;
    }

    /**
     * @return ModuleMetadataRepository
     */
    public function getModuleMetadataRepository(): ModuleMetadataRepository
    {
        return $this->moduleMetadataRepository;
    }

    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    /**
     * @param string $entity_class_name
     * @return DataTable
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \ReflectionException
     */
    public function getDataTable(string $entity_class_name):DataTable
    {
        $entity_reflection_class = new \ReflectionClass($entity_class_name);
        $entity_class_name = $entity_reflection_class->getName();
        if (!isset($this->dataTable[$entity_class_name])) {
            $this->entityReflectionClass[$entity_class_name] = $entity_reflection_class;
            $this->dataTable[$entity_class_name] = new DataTable($entity_reflection_class, $this);
        }
        return $this->dataTable[$entity_class_name];
    }


}