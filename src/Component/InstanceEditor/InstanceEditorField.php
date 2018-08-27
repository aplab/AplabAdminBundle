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
     * @var
     */
    private $tab;

    /**
     * InstanceEditorField constructor.
     * @param \ReflectionProperty $property
     * @param Property $property_metadata
     * @param Widget $widget_metadata
     * @param FieldTypeFactory $factory
     */
    public function __construct(\ReflectionProperty $property, Property $property_metadata,
                                Widget $widget_metadata, FieldTypeFactory $factory)
    {
        $this->propertyName = $property->getName();
        $this->propertyTitle = $property_metadata->getTitle();
        $this->order = $widget_metadata->getOrder();
        $this->type = $factory->create($widget_metadata->getType());
        $this->options = $widget_metadata->getOptions();
        $this->tab = $widget_metadata->getTab();
    }
}