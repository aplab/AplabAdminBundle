<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 25.08.2018
 * Time: 17:56
 */

namespace Aplab\AplabAdminBundle\Controller;


use Aplab\AplabAdminBundle\Component\DataTableRepresentation\DataTableRepresentation;
use Aplab\AplabAdminBundle\Component\Helper\AdminControllerHelper;
use Aplab\AplabAdminBundle\Component\Toolbar\Handler;
use Aplab\AplabAdminBundle\Component\Toolbar\Icon;
use Aplab\AplabAdminBundle\Component\Toolbar\ToolbarItem;
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
     * @param DataTableRepresentation $data_table_representation
     * @param AdminControllerHelper $helper
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \ReflectionException
     * @throws \Aplab\AplabAdminBundle\Component\Toolbar\Exception
     */
    public function listItems(DataTableRepresentation $data_table_representation, AdminControllerHelper $helper)
    {
        $toolbar = $helper->getToolbar();
        $toolbar->addItem((new ToolbarItem('addItem', 'Add item'))->addIcon(new Icon('fas fa-plus')));
        $toolbar->addItem((new ToolbarItem('dropItem', 'Drop selected'))
            ->addIcon(new Icon('fas fa-trash-alt'))
            ->setAction(new Handler('AplDataTable.getInstance().del();')));
        $data_table = $data_table_representation->getDataTable(NamedTimestampable::class);
        $pager = $data_table->getPager();
        if (isset($_POST['itemsPerPage']) && isset($_POST['pageNumber'])) {
            $pager->setItemsPerPage($_POST['itemsPerPage']);
            $pager->setCurrentPage($_POST['pageNumber']);
        }
        return $this->render('@AplabAdmin/data-table/data-table.html.twig', get_defined_vars());
    }

    /**
     * @Route("/add", name="add")
     */
    public function addItem()
    {
        return new Response('test');
    }

    /**
     * @Route("/{id}", name="edit")
     * @param $id
     * @return Response
     */
    public function editItem($id)
    {
        return new Response($id);
    }
}