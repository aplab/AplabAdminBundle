<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 02.08.2018
 * Time: 10:57
 */

namespace Aplab\AplabAdminBundle\Component\InstanceEditor;


class InstanceEditorTab
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $order;

    /**
     * @var InstanceEditorField[]
     */
    protected $field;

    /**
     * InstanceEditorTab constructor.
     */
    public function __construct()
    {
        $this->field = [];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return InstanceEditorTab
     */
    public function setName(string $name): InstanceEditorTab
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * @param int $order
     * @return InstanceEditorTab
     */
    public function setOrder(int $order): InstanceEditorTab
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return InstanceEditorField[]
     */
    public function getField(): array
    {
        return $this->field;
    }

    /**
     * @param InstanceEditorField $field
     * @return InstanceEditorTab
     */
    public function addField(InstanceEditorField $field): InstanceEditorTab
    {
        $this->field[] = $field;
        usort($this->field, function (InstanceEditorField $a, InstanceEditorField $b) {
            return $a->getOrder() <=> $b->getOrder();
        });
        return $this;
    }
}