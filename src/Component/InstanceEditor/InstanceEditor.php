<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 02.08.2018
 * Time: 10:57
 */

namespace Aplab\AplabAdminBundle\Component\InstanceEditor;


use Aplab\AplabAdminBundle\Component\InstanceEditor\FieldType\FieldTypeFactory;
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
     * @var InstanceEditorField[]
     */
    protected $widget;

    /**
     * @var InstanceEditorTab[]
     */
    protected $tab;

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
        $tab_names = [];
        // find required tabs
        foreach ($this->widget as $widget) {
            $tab_name = $widget->getTab();
            if (!isset($tab_names[$tab_name])) {
                $tab_names[$tab_name] = $tab_name;
            }
        }
        // create tabs
        $number = 0;
        foreach ($tab_names as $tab_name) {
            $tab = new InstanceEditorTab;
            $this->tab[] = $tab;
            $tab->setName($tab_name);
            $tab->setOrder($tab_order_configuration[$tab_name] ?? $number++);
        }
        // building tab index
        /**
         * @var InstanceEditorTab[]
         */
        $tab_index = [];
        foreach ($this->tab as $tab) {
            $tab_name = $tab->getName();
            $tab_index[$tab_name] = $tab;
        }
        usort($this->tab, function (InstanceEditorTab $a, InstanceEditorTab $b) {
            return $a->getOrder() <=> $b->getOrder();
        });
        // distribute widgets to tabs
        foreach ($this->widget as $widget) {
            $tab_name = $widget->getTab();
            if (isset($tab_index[$tab_name])) {
                $tab_index[$tab_name]->addField($widget);
            }
        }
    }

    /**
     * @return object
     */
    public function getEntity(): object
    {
        return $this->entity;
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
    public function getEntityManagerInterface(): EntityManagerInterface
    {
        return $this->entityManagerInterface;
    }

    /**
     * @return \Aplab\AplabAdminBundle\Component\ModuleMetadata\ModuleMetadata
     */
    public function getModuleMetadata(): \Aplab\AplabAdminBundle\Component\ModuleMetadata\ModuleMetadata
    {
        return $this->moduleMetadata;
    }

    /**
     * @return \Doctrine\ORM\Mapping\ClassMetadata
     */
    public function getClassMetadata(): \Doctrine\ORM\Mapping\ClassMetadata
    {
        return $this->classMetadata;
    }

    /**
     * @return InstanceEditorField[]
     */
    public function getWidget(): array
    {
        return $this->widget;
    }

    /**
     * @return InstanceEditorTab[]
     */
    public function getTab(): array
    {
        return $this->tab;
    }
}