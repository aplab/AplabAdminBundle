<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 02.08.2018
 * Time: 10:57
 */

namespace Aplab\AplabAdminBundle\Component\InstanceEditor;


use Aplab\AplabAdminBundle\Component\InstanceEditor\FieldType\FieldTypeFactory;
use Aplab\AplabAdminBundle\Component\InstanceEditor\FieldType\FieldTypeInterface;
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

    /**
     * @var \Aplab\AplabAdminBundle\Component\ModuleMetadata\ModuleMetadata
     */
    protected $moduleMetadata;

    /**
     * @var \Doctrine\ORM\Mapping\ClassMetadata
     */
    protected $classMetadata;

    /**
     * @var FieldTypeInterface[]
     */
    protected $widget;

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

    /**
     * Configrue Instance editor
     */
    protected function configure()
    {
        $this->configureFields();
        $this->configureTabs();
    }

    /**
     * First configure fields
     */
    protected function configureFields()
    {
        $factory = new FieldTypeFactory();
        $this->widget = [];
        $properties = $this->moduleMetadata->getProperties();
        foreach ($properties as $property_name => $property_metadata) {
            $widget_metadata_list = $property_metadata->getWidget();
            $property = $this->classMetadata->getReflectionProperty($property_name);
            foreach ($widget_metadata_list as $widget_metadata) {
                $this->widget[] = new InstanceEditorField($property, $property_metadata, $widget_metadata, $factory);
            }
        }
        usort($this->widget, function (InstanceEditorField $a, InstanceEditorField $b) {
            return $a->getOrder() <=> $b->getOrder();
        });
    }

    /**
     * configure tabs
     */
    protected function configureTabs()
    {
        $tab_order_configuration = $this->moduleMetadata->getModule()->getTabOrder();
        dump($tab_order_configuration);
    }
}