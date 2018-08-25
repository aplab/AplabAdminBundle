<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 02.08.2018
 * Time: 10:42
 */

namespace Aplab\AplabAdminBundle\Component\DataTableRepresentation;


use Aplab\AplabAdminBundle\Component\ModuleMetadata\ModuleMetadataRepository;
use Aplab\AplabAdminBundle\Component\SystemState\SystemStateManager;
use Aplab\AplabAdminBundle\Util\CssWidthDefinition;
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
     * @var CssWidthDefinition
     */
    private $cssWidthDefinition;

    /**
     * @var SystemStateManager
     */
    private $systemStateManager;

    /**
     * @var int
     */
    private $itemsPerPage = 100;

    /**
     * @var array
     */
    private $itemsPerPageVariants = [
        10,
        50,
        100,
        200,
        500
    ];

    /**
     * DataTable constructor.
     * @param ModuleMetadataRepository $mmr
     * @param EntityManagerInterface $emi
     * @param CssWidthDefinition $cwd
     * @param SystemStateManager $ssm
     */
    public function __construct(ModuleMetadataRepository $mmr, EntityManagerInterface $emi,
                                CssWidthDefinition $cwd, SystemStateManager $ssm)
    {
        $this->moduleMetadataRepository = $mmr;
        $this->entityManager = $emi;
        $this->cssWidthDefinition = $cwd;
        $this->systemStateManager = $ssm;
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

    /**
     * @return CssWidthDefinition
     */
    public function getCssWidthDefinition(): CssWidthDefinition
    {
        return $this->cssWidthDefinition;
    }

    /**
     * @return \ReflectionClass[]
     */
    public function getEntityReflectionClass(): array
    {
        return $this->entityReflectionClass;
    }

    /**
     * @return SystemStateManager
     */
    public function getSystemStateManager(): SystemStateManager
    {
        return $this->systemStateManager;
    }

    /**
     * @return int
     */
    public function getItemsPerPage(): int
    {
        return $this->itemsPerPage;
    }

    /**
     * @return array
     */
    public function getItemsPerPageVariants(): array
    {
        return $this->itemsPerPageVariants;
    }

    /**
     * @param int $itemsPerPage
     * @return DataTableRepresentation
     */
    public function setItemsPerPage(int $itemsPerPage): DataTableRepresentation
    {
        $this->itemsPerPage = $itemsPerPage;
        return $this;
    }

    /**
     * @param array $itemsPerPageVariants
     * @return DataTableRepresentation
     */
    public function setItemsPerPageVariants(array $itemsPerPageVariants): DataTableRepresentation
    {
        $this->itemsPerPageVariants = $itemsPerPageVariants;
        return $this;
    }
}