<?php

namespace Aplab\AplabAdminBundle\Entity\AdjacencyList;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ListItem
 * @package Aplab\AplabAdminBundle\Entity\AdjacencyList
 * @ORM\Entity(repositoryClass="Aplab\AplabAdminBundle\Repository\AdjacencyListItemRepository")
 * @ORM\Table(name="adjacency_list", indexes={
 *      @ORM\Index(name="parent_id", columns={"parent_id"})
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
     */
    private $children;

    /**
     * Many Categories have One Category.
     * @ORM\ManyToOne(targetEntity="\Aplab\AplabAdminBundle\Entity\AdjacencyList\ListItem", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

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

    public function addChild(ListItem $child): self
    {
        if ($child === $this) {
            throw new \LogicException('Unable to set object as child of itself.');
        }
        if (!$this->children->contains($child)) {
            $this->children[] = $child;
            $child->setParent($this);
        }

        return $this;
    }

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

    public function setParent(?ListItem $parent): self
    {
        if ($parent === $this) {
            throw new \LogicException('Unable to set object as parent of itself.');
        }
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }


}
