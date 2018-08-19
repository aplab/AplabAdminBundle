<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 06.08.2018
 * Time: 10:31
 */

namespace Aplab\AplabAdminBundle\Controller;


use Aplab\AplabAdminBundle\Component\Menu\Menu;
use Aplab\AplabAdminBundle\Component\Menu\MenuManager;
use Aplab\AplabAdminBundle\Repository\SampleEntityRepository;
use Aplab\AplabAdminBundle\Tools\Tools;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @package Aplab\AplabAdminBundle\Controller
 * @Route("/admin", name="admin_")
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="desktop")
     * @param SampleEntityRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function desktop(SampleEntityRepository $repository)
    {
        $count = $repository->count([]);
        $items = $repository->findAll();
        return $this->render('@AplabAdmin/admin.html.twig', get_defined_vars());
    }
}