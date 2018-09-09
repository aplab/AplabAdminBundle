<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 02.08.2018
 * Time: 10:59
 */

namespace Aplab\AplabAdminBundle\Component\InstanceEditor\FieldType;


class FieldTypeTree extends FieldTypeAbstract
{
    /**
     * @return mixed
     */
    public function getValue()
    {
        $entity = $this->field->getEntity();
        $property_name = $this->field->getPropertyName();
        $property_name_ucfirst = ucfirst($property_name);
        $accessors = [
            'getter' => 'get' . $property_name_ucfirst,
            'isser' => 'is' . $property_name_ucfirst,
            'hasser' => 'has' . $property_name_ucfirst
        ];
        return 'stub';
        foreach ($accessors as $accessor) {
            if (method_exists($entity, $accessor)) {
                return $entity->$accessor();
            }
        }
        throw new \LogicException('Unable to access property ' . get_class($entity) . '::' . $property_name);
    }

    public function getOptionsDataList()
    {
        $field_options = $this->field->getOptions();
        $class = $field_options->class ?? get_class($this->field->getEntity());
        $em = $this->field->getInstanceEditor()->getEntityManagerInterface();
        $repository = $em->getRepository($class);
        return $repository->getOptionsDataList();
    }
}