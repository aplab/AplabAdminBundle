<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 25.08.2018
 * Time: 17:56
 */

namespace Aplab\AplabAdminBundle\Controller;


use Aplab\AplabAdminBundle\Component\DataTableRepresentation\DataTableRepresentation;
use Aplab\AplabAdminBundle\Component\InstanceEditor\InstatceEditorManager;
use Aplab\AplabAdminBundle\Entity\NamedTimestampable;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NamedTimestampableController
 * @package Aplab\AplabAdminBundle\Controller
 * @Route("/admin/named-timestampable", name="admin_named_timestampable_")
 */
class NamedTimestampableController extends BaseAdminController
{
    /**
     * @var string
     */
    protected $entityClassName = NamedTimestampable::class;

    /**
     * @Route("/", name="list", methods="GET")
     * @param DataTableRepresentation $data_table_representation
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \ReflectionException
     * @throws \Aplab\AplabAdminBundle\Component\Toolbar\Exception
     */
    public function listItems(DataTableRepresentation $data_table_representation)
    {
        $helper = $this->adminControllerHelper;
        $toolbar = $this->adminControllerHelper->getToolbar();
        $toolbar->addUrl('Add item', $helper->getModulePath('add'), 'fas fa-plus');
        $toolbar->addHandler('Drop selected', 'AplDataTable.getInstance().del();', 'fas fa-trash-alt');

        $data_table = $data_table_representation->getDataTable($this->getEntityClassName());
        dump($data_table->getModuleMetadata());
        $pager = $data_table->getPager();
        return $this->render('@AplabAdmin/data-table/data-table.html.twig', get_defined_vars());
    }

    /**
     * @Route("/", name="list_param", methods="POST")
     * @param DataTableRepresentation $data_table_representation
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \ReflectionException
     */
    public function setListParam(DataTableRepresentation $data_table_representation)
    {
        if (isset($_POST['itemsPerPage']) && isset($_POST['pageNumber'])) {
            $data_table = $data_table_representation->getDataTable($this->getEntityClassName());
            $pager = $data_table->getPager();
            $pager->setItemsPerPage($_POST['itemsPerPage']);
            $pager->setCurrentPage($_POST['pageNumber']);
        }
        return $this->redirectToRoute('admin_named_timestampable_list');
    }

    /**
     * @Route("/del", name="drop", methods="POST")
     */
    public function dropItem()
    {
        $class = $this->getEntityClassName();
        $entity_manager = $this->getDoctrine()->getManager();
        $class_metadata = $entity_manager->getClassMetadata($class);
        $pk = $class_metadata->getIdentifier();
        /**
         * @TODO composite key support
         */
        if (empty($pk)) {
            throw new \RuntimeException('identifier not found');
        }
        if (sizeof($pk) > 1) {
            throw new \RuntimeException('composite identifier not supported');
        }
        $key = reset($pk);
        $ids = $_POST[$key];
        $ids = json_decode($ids);
        $items = $entity_manager->getRepository($class)->findBy([$key => $ids]);
        foreach ($items as $item) {
            $entity_manager->remove($item);
        }
        $entity_manager->flush();
        return $this->redirectToRoute('admin_named_timestampable_list');
    }

    /**
     * @Route("/add", name="add")
     * @param InstatceEditorManager $instatceEditorManager
     * @return Response
     */
    public function addItem(InstatceEditorManager $instatceEditorManager)
    {
        $entity_class_name = $this->getEntityClassName();
        $item = new $entity_class_name;
        dump($instatceEditorManager->getInstanceEditor($item));
        return $this->render('@AplabAdmin/admin.html.twig', get_defined_vars());
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