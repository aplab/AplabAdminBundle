<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 30.07.2018
 * Time: 20:39
 */

namespace Aplab\AplabAdminBundle\Component\ModuleMetadata;


use Doctrine\Common\Annotations\Annotation\Attribute;
use Doctrine\Common\Annotations\Annotation\Attributes;
use Doctrine\Common\Annotations\Annotation\Target;
use Doctrine\ORM\Mapping\Annotation;

/**
 * Class Vidget
 * @package Aplab\AplabAdminBundle\Annotation\Module
 * @Annotation
 * @Target({"ANNOTATION"})
 * @Attributes({
 *      @Attribute("tab", type="string", required=true),
 *      @Attribute("order", type="integer", required=true),
 *      @Attribute("type", type="string", required=true),
 *      @Attribute("options", type="Aplab\AplabAdminBundle\Component\ModuleMetadata\Options", required=false),
 *     })
 */
class Widget implements Annotation
{
    /**
     * Vidget constructor.
     * @param array $values
     */
    public function __construct(array $values)
    {
        $this->tab = $values['tab'];
        $this->order = $values['order'];
        $this->type = $values['type'];
        $this->options = $values['options'] ?? new Options;
    }

    /**
     * @var Options
     */
    private $options;

    /**
     * @return Options
     */
    public function getOptions(): Options
    {
        return $this->options;
    }

    /**
     * @param Options $options
     * @return Widget
     */
    public function setOptions(Options $options): Widget
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @var string
     */
    private $tab;

    /**
     * @var integer
     */
    private $order;

    /**
     * @var string
     */
    private $type;

    /**
     * @return int
     */
    public function getTab(): int
    {
        return $this->tab;
    }

    /**
     * @param int $tab
     * @return Widget
     */
    public function setTab(int $tab): Widget
    {
        $this->tab = $tab;
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
     * @return Widget
     */
    public function setOrder(int $order): Widget
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Widget
     */
    public function setType(string $type): Widget
    {
        $this->type = $type;
        return $this;
    }
}