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
use Aplab\AplabAdminBundle\Component\ModuleMetadata\Options;
use Aplab\AplabAdminBundle\Component\ModuleMetadata\Property;
use Aplab\AplabAdminBundle\Component\ModuleMetadata\Widget;

class InstanceEditorField
{
    /**
     * @var InstanceEditor
     */
    private $instanceEditor;

    /**
     * @var object
     */
    private $entity;

    /**
     * @var string
     */
    private $propertyName;

    /**
     * @var string
     */
    private $propertyTitle;

    /**
     * @var int
     */
    private $order;

    /**
     * @var FieldTypeInterface
     */
    private $type;

    /**
     * @var Options
     */
    private $options;

    /**
     * @var string
     */
    private $tab;

    /**
     * InstanceEditorField constructor.
     * @param InstanceEditor $instance_editor
     * @param \ReflectionProperty $property
     * @param Property $property_metadata
     * @param Widget $widget_metadata
     * @param FieldTypeFactory $factory
     */
    public function __construct(InstanceEditor $instance_editor, \ReflectionProperty $property,
                                Property $property_metadata, Widget $widget_metadata, FieldTypeFactory $factory)
    {
        $this->instanceEditor = $instance_editor;
        $this->propertyName = $property->getName();
        $this->propertyTitle = $property_metadata->getTitle();
        $this->order = $widget_metadata->getOrder();
        $this->type = $factory->create($this, $widget_metadata->getType());
        $this->options = $widget_metadata->getOptions();
        $this->tab = $widget_metadata->getTab();
        $this->entity = $instance_editor->getEntity();
    }

    /**
     * @return string
     */
    public function getPropertyName(): string
    {
        return $this->propertyName;
    }

    /**
     * @return string
     */
    public function getPropertyTitle(): string
    {
        return $this->propertyTitle;
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * @return FieldTypeInterface
     */
    public function getType(): FieldTypeInterface
    {
        return $this->type;
    }

    /**
     * @return Options
     */
    public function getOptions(): Options
    {
        return $this->options;
    }

    /**
     * @return string
     */
    public function getTab(): string
    {
        return $this->tab;
    }

    /**
     * @return InstanceEditor
     */
    public function getInstanceEditor(): InstanceEditor
    {
        return $this->instanceEditor;
    }

    /**
     * @return object
     */
    public function getEntity(): object
    {
        return $this->entity;
    }
}