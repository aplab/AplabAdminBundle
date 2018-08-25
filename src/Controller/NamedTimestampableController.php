<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 25.08.2018
 * Time: 17:56
 */

namespace Aplab\AplabAdminBundle\Controller;


use Aplab\AplabAdminBundle\Component\DataTableRepresentation\DataTableRepresentation;
use Aplab\AplabAdminBundle\Entity\NamedTimestampable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NamedTimestampableController
 * @package Aplab\AplabAdminBundle\Controller
 * @Route("/admin/named-timestampable", name="admin_named_timestampable_")
 */
class NamedTimestampableController extends AbstractController
{
    /**
     * @Route("/", name="list")
     * @param DataTableRepresentation $dtr
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \ReflectionException
     */
    public function listItems(DataTableRepresentation $dtr)
    {
        $dt = $dtr->getDataTable(NamedTimestampable::class);
        $cell = $dt->getCell();
        $pager = $dt->getPager();
        if (isset($_POST['itemsPerPage'])) {
            $pager->setItemsPerPage($_POST['itemsPerPage']);
        }
        if (isset($_POST['pageNumber'])) {
            $pager->setCurrentPage($_POST['pageNumber']);
        }
        $items = $dt->getItems();
        return $this->render('@AplabAdmin/data-table/data-table.html.twig', get_defined_vars());
    }

    /**
     * @Route("/test", name="test")
     */
    public function test()
    {
        return $this->redirectToRoute('admin_named_timestampable_list');
    }
}