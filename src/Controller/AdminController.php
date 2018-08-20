<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 06.08.2018
 * Time: 10:31
 */

namespace Aplab\AplabAdminBundle\Controller;


use Aplab\AplabAdminBundle\Component\DataTableRepresentation\DataTableRepresentation;
use Aplab\AplabAdminBundle\Component\ModuleMetadata\ModuleMetadataRepository;
use Aplab\AplabAdminBundle\Entity\NamedTimestampable;
use Aplab\AplabAdminBundle\Repository\NamedTimestampableRepository;
use Aplab\AplabAdminBundle\Util\CssWidthDefinition;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @package Aplab\AplabAdminBundle\Controller
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="desktop")
     * @param DataTableRepresentation $dtr
     * @param CssWidthDefinition $cwd
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \ReflectionException
     */
    public function desktop(DataTableRepresentation $dtr, CssWidthDefinition $cwd) {

        $cwd->add(60)->add(100)->add(200);
        $dt = $dtr->getDataTable(NamedTimestampable::class);

        $cell = $dt->getCell();

        return $this->render('@AplabAdmin/admin.html.twig', get_defined_vars());
    }
}