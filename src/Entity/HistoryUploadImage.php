<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 04.09.2018
 * Time: 16:34
 */

namespace Aplab\AplabAdminBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class HistoryUploadImage
 * @package Aplab\AplabAdminBundle\Entity
 * @ORM\Entity(repositoryClass="Aplab\AplabAdminBundle\Repository\HistoryUploadImageRepository")
 * @ORM\Table(name="history_upload_image", indexes={
 *      @ORM\Index(name="path", columns={"path"}),
 *      @ORM\Index(name="favorites", columns={"favorites"})
 *     })
 */
class HistoryUploadImage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigint", options={"unsigned"=true})
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $path;

    /**
     * @ORM\Column(type="string")
     */
    private $thumbnail;

    /**
     * @ORM\Column(type="text")
     */
    private $comment;

    /**
     * @ORM\Column(type="integer", options={"unsigned"=true})
     */
    private $width;

    /**
     * @ORM\Column(type="integer", options={"unsigned"=true})
     */
    private $height;

    /**
     * @ORM\Column(type="boolean")
     */
    private $favorites;

    /**
     * @ORM\Column(
     *     type="datetime",
     *     nullable=true,
     *     columnDefinition="DATETIME NULL DEFAULT CURRENT_TIMESTAMP",
     *     options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * HistoryUploadImage constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime;
    }

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
     * @return HistoryUploadImage
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     * @return HistoryUploadImage
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @param mixed $thumbnail
     * @return HistoryUploadImage
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     * @return HistoryUploadImage
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     * @return HistoryUploadImage
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     * @return HistoryUploadImage
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFavorites()
    {
        return $this->favorites;
    }

    /**
     * @param mixed $favorites
     * @return HistoryUploadImage
     */
    public function setFavorites($favorites)
    {
        $this->favorites = $favorites;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}