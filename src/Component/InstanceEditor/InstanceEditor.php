<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 02.08.2018
 * Time: 10:57
 */

namespace Aplab\AplabAdminBundle\Component\InstanceEditor;


use Aplab\AplabAdminBundle\Component\ModuleMetadata\ModuleMetadataRepository;
use Doctrine\ORM\EntityManagerInterface;

class InstanceEditor
{
    /**
     * @var object
     */
    protected $entity;

    /**
     * @var ModuleMetadataRepository
     */
    protected $moduleMetadataRepository;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManagerInterface;

    protected $moduleMetadata;

    protected $classMetadata;

    /**
     * InstanceEditor constructor.
     * @param object $entity
     * @param InstatceEditorManager $instance_editor_manager
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \ReflectionException
     */
    public function __construct(object $entity, InstatceEditorManager $instance_editor_manager)
    {
        $this->entity = $entity;
        $this->moduleMetadataRepository = $instance_editor_manager->getModuleMetadataRepository();
        $this->entityManagerInterface = $instance_editor_manager->getEntityManagerInterface();
        $this->moduleMetadata = $this->moduleMetadataRepository->getMetadata($this->entity);
        $this->classMetadata = $this->entityManagerInterface->getClassMetadata($this->moduleMetadata->getClassName());
        $this->configure();
    }

    protected function configure()
    {

    }
}