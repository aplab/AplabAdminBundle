<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 06.09.2018
 * Time: 9:09
 */

namespace Aplab\AplabAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MenuItem
 *
 * @ORM\Table(name="menu_item")
 * ###ORM\Entity(repositoryClass="AppBundle\Repository\MenuItemRepository")
 * @ORM\Entity()
 */
class Category
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="MenuItem", mappedBy="parentId")
     */
    private $id;



    /**
     * @var int
     * @ORM\Column(name="parent", type="integer", nullable=true)
     * @ORM\ManyToOne(targetEntity="MenuItem", inversedBy="id")
     * @ORM\JoinColumn(name="parent", referencedColumnName="id")
     */
    private $parentId;

    /**
     * @ORM\ManyToMany(targetEntity="Menu", mappedBy="menuitems")
     */
    private $menus;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->menus = new \Doctrine\Common\Collections\ArrayCollection();
        $this->id = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add menu
     *
     * @param \AppBundle\Entity\Menu $menu
     *
     * @return MenuItem
     */
    public function addMenu(\AppBundle\Entity\Menu $menu)
    {
        $this->menus[] = $menu;

        return $this;
    }

    /**
     * Remove menu
     *
     * @param \AppBundle\Entity\Menu $menu
     */
    public function removeMenu(\AppBundle\Entity\Menu $menu)
    {
        $this->menus->removeElement($menu);
    }

    /**
     * Get menus
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMenus()
    {
        return $this->menus;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set parent
     *
     * @param $parentId
     * @return Category
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Get parent
     * @return integer
     */
    public function getParentId()
    {
        return $this->parentId;
    }
}