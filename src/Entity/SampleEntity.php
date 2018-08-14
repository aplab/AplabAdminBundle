<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 03.08.2018
 * Time: 16:01
 */

namespace Aplab\AplabAdminBundle\Entity;

use Aplab\AplabAdminBundle\Component\ModuleMetadata as Aplab\AplabAdminBundle;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="\Aplab\AplabAdminBundle\Repository\SampleEntityRepository")
 * @ORM\Table(name="my_sample_entity")
 * @Aplab\AplabAdminBundle\Module(
 *     title="Test entity title",
 *     description="Test entity description",
 *     tabOrder={
 *          "General": 1000,
 *          "Photo": 3000,
 *          "Contact": 4000,
 *          "SEO": 5000,
 *          "SEO2": 5000,
 *          "Additional": 10000418
 *     })
 */
class SampleEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigint")
     * @Aplab\AplabAdminBundle\Property(title="ID",
     *     cell={
     *         @Aplab\AplabAdminBundle\Cell(order=1000, width=60, type="Label"),
     *         @Aplab\AplabAdminBundle\Cell(order=2000, width=200, type="Label")
     *     },
     *     widget={
     *         @Aplab\AplabAdminBundle\Widget(order=1000, tab="General", type="Label", options=@Aplab\AplabAdminBundle\Options(test={"a":234}))
     *     })
     */
    protected $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}