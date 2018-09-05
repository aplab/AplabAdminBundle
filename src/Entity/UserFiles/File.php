<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 05.09.2018
 * Time: 16:03
 */

namespace Aplab\AplabAdminBundle\Entity\UserFiles;

use Aplab\AplabAdminBundle\Component\ModuleMetadata as ModuleMetadata;
use Aplab\AplabAdminBundle\Util\Path;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class File
 * @package Aplab\AplabAdminBundle\Entity\Userfiles
 * @ORM\Entity(repositoryClass="Aplab\AplabAdminBundle\Repository\UserFilesRepository")
 * @ORM\Table(name="user_files")
 * @ModuleMetadata\Module(
 *     title="User files",
 *     description="User file entity",
 *     tabOrder={
 *          "General": 1000,
 *          "Additional": 10000418
 *     })
 */
class File
{
    public function __construct()
    {
        $this->createdAt = new \DateTime;
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigint")
     * @ModuleMetadata\Property(title="ID", readonly=true,
     *     cell={
     *         @ModuleMetadata\Cell(order=1000, width=80, type="EditId")
     *     },
     *     widget={
     *         @ModuleMetadata\Widget(order=1000, tab="Additional", type="Label")
     *     })
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Name should be not blank")
     * @ModuleMetadata\Property(title="Name",
     *     cell={@ModuleMetadata\Cell(order=2000, width=200, type="Label")},
     *     widget={@ModuleMetadata\Widget(order=2000, tab="General", type="Text")})
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     * @ModuleMetadata\Property(title="Filename",
     *     cell={@ModuleMetadata\Cell(order=2000, width=400, type="Label")},
     *     widget={})
     */
    private $filename;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Name should be not blank")
     * @ModuleMetadata\Property(title="Content type",
     *     cell={@ModuleMetadata\Cell(order=2000, width=160, type="Label")},
     *     widget={})
     */
    private $contentType;

    /**
     * @ORM\Column(
     *     type="datetime",
     *     nullable=true,
     *     columnDefinition="DATETIME NULL DEFAULT CURRENT_TIMESTAMP",
     *     options={"default"="CURRENT_TIMESTAMP"}
     * )
     * @ModuleMetadata\Property(title="Created at", readonly=true,
     *     cell={@ModuleMetadata\Cell(order=2000, width=156, type="Datetime")},
     *     widget={@ModuleMetadata\Widget(order=2000, tab="Additional", type="DateTime")})
     */
    private $createdAt;

    /**
     * @ORM\Column(
     *     type="datetime",
     *     nullable=true,
     *     columnDefinition="DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
     *     options={"default"="CURRENT_TIMESTAMP"}
     * )
     * @ModuleMetadata\Property(title="Last modified", readonly=true,
     *     cell={@ModuleMetadata\Cell(order=2000, width=156, type="Datetime")},
     *     widget={@ModuleMetadata\Widget(order=2000, tab="Additional", type="DateTime")})
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
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return File
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

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param mixed $filename
     * @return File
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @param mixed $contentType
     * @return File
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        return $this;
    }



    /**
     * @return string
     */
    protected function getDirectLink()
    {
        $path_part = '/' . join('/', array_slice(str_split($this->filename, 3), 0, 3));
        $path = new Path(
            $this->config()->directLinkPrefix,
            $path_part,
            $this->filename
        );
        return (string)$path;
    }

    protected function getLink()
    {
        $path = new Path(
            $this->config()->linkPrefix,
            $this->id,
            $this->name
        );
        return (string)$path;
    }
}