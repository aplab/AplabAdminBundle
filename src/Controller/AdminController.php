<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 06.08.2018
 * Time: 10:31
 */

namespace Aplab\AplabAdminBundle\Controller;


use Aplab\AplabAdminBundle\Component\DataTableRepresentation\DataTableRepresentation;
use Aplab\AplabAdminBundle\Entity\NamedTimestampable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \ReflectionException
     */
    public function desktop(DataTableRepresentation $dtr) {

        $dt = $dtr->getDataTable(NamedTimestampable::class);

        $cell = $dt->getCell();
        foreach ($cell as $item) {
            $item->getType()->getType();
        }

        return $this->render('@AplabAdmin/admin.html.twig', get_defined_vars());
    }
}