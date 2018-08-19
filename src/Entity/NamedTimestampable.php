<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 19.08.2018
 * Time: 16:01
 */

namespace Aplab\AplabAdminBundle\Entity;

use Aplab\AplabAdminBundle\Component\ModuleMetadata as ModuleMetadata;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class NamedTimestampable
 * @package Aplab\AplabAdminBundle\Entity
 * @ORM\Entity(repositoryClass="Aplab\AplabAdminBundle\Repository\NamedTimestampableRepository")
 * @ORM\Table(name="named_timestampable")
 * @ModuleMetadata\Module(
 *     title="Named timestampable",
 *     description="Named timestampable entity",
 *     tabOrder={
 *          "General": 1000,
 *          "Additional": 10000418
 *     })
 */
class NamedTimestampable
{
    public function __construct()
    {
        dump($this);
        $this->createdAt = new \DateTime;
        dump($this);
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigint")
     * @ModuleMetadata\Property(title="ID",
     *     cell={
     *         @ModuleMetadata\Cell(order=1000, width=60, type="Label"),
     *         @ModuleMetadata\Cell(order=2000, width=200, type="Label")
     *     },
     *     widget={
     *         @ModuleMetadata\Widget(order=1000, tab="Additional", type="Label")
     *     })
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @ModuleMetadata\Property(title="ID",
     *     cell={@ModuleMetadata\Cell(order=2000, width=200, type="Label")},
     *     widget={@ModuleMetadata\Widget(order=2000, tab="General", type="Label")})
     */
    private $name;

    /**
     * @ORM\Column(
     *     type="datetime",
     *     nullable=true,
     *     columnDefinition="DATETIME NULL DEFAULT CURRENT_TIMESTAMP",
     *     options={"default"="CURRENT_TIMESTAMP"}
     * )
     * @ModuleMetadata\Property(title="Created at",
     *     cell={@ModuleMetadata\Cell(order=2000, width=200, type="Label")},
     *     widget={@ModuleMetadata\Widget(order=2000, tab="General", type="Label")})
     */
    private $createdAt;

    /**
     * @ORM\Column(
     *     type="datetime",
     *     nullable=true,
     *     columnDefinition="DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
     *     options={"default"="CURRENT_TIMESTAMP"}
     * )
     * @ModuleMetadata\Property(title="Last modified",
     *     cell={@ModuleMetadata\Cell(order=2000, width=200, type="Label")},
     *     widget={@ModuleMetadata\Widget(order=2000, tab="General", type="Label")})
     */
    private $lastModified;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return NamedTimestampable
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return NamedTimestampable
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }
}