<?php

namespace Aplab\AplabAdminBundle\Entity\AdjacencyList;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Aplab\AplabAdminBundle\Component\ModuleMetadata as ModuleMetadata;

/**
 * Class ListItem
 * @package Aplab\AplabAdminBundle\Entity\AdjacencyList
 * @ORM\Entity(repositoryClass="Aplab\AplabAdminBundle\Repository\AdjacencyListItemRepository")
 * @ORM\Table(name="adjacency_list", indexes={
 *      @ORM\Index(name="parent_id", columns={"parent_id"}),
 *      @ORM\Index(name="order", columns={"order"}),
 *      @ORM\Index(name="order_id", columns={"order", "id"})
 *     })
 */
class ListItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="\Aplab\AplabAdminBundle\Entity\AdjacencyList\ListItem", mappedBy="parent")
     * @ORM\OrderBy({"order" = "ASC", "id" = "ASC"})
     */
    private $children;

    /**
     * Many Categories have One Category.
     * @ORM\ManyToOne(targetEntity="\Aplab\AplabAdminBundle\Entity\AdjacencyList\ListItem", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $parent;

    /**
     * @ORM\Column(type="bigint")
     */
    private $order;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Name should be not blank")
     * @ModuleMetadata\Property(title="Name",
     *     cell={@ModuleMetadata\Cell(order=2000, width=320, type="Label")},
     *     widget={@ModuleMetadata\Widget(order=2000, tab="General", type="Text")})
     */
    private $name;

    /**
     * ListItem constructor.
     */
    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->order = 0;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|ListItem[]
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    /**
     * @param ListItem $child
     * @return ListItem
     */
    public function addChild(ListItem $child): self
    {
        if ($child === $this) {
            throw new \LogicException('Unable to set object as child of itself.');
        }
        $parent_of_child = $child->getParent();
        while($parent_of_child) {
            if ($parent_of_child === $this) {
                throw new \LogicException('Unable to add ancestor as child.');
            }
        }
        if (!$this->children->contains($child)) {
            $this->children[] = $child;
            $child->setParent($this);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param ListItem|null $parent
     * @return ListItem
     */
    public function setParent(?ListItem $parent): self
    {
        if ($parent === $this) {
            throw new \LogicException('Unable to set object as parent of itself.');
        }
        $parent_of_parent = $parent->getParent();
        while($parent_of_parent) {
            if ($parent_of_parent === $this) {
                throw new \LogicException('Unable to set descendant as parent.');
            }
        }
        $this->parent = $parent;
        return $this;
    }

    /**
     * @param ListItem $child
     * @return ListItem
     */
    public function removeChild(ListItem $child): self
    {
        if ($this->children->contains($child)) {
            $this->children->removeElement($child);
            // set the owning side to null (unless already changed)
            if ($child->getParent() === $this) {
                $child->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     * @return ListItem
     */
    public function setOrder($order)
    {
        $this->order = $order;
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
     * @return ListItem
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}
