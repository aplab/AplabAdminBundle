<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 06.08.2018
 * Time: 10:31
 */

namespace Aplab\AplabAdminBundle\Controller;


use Aplab\AplabAdminBundle\Component\Menu\MenuManager;
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
     * @param MenuManager $main_menu
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Aplab\AplabAdminBundle\Component\Menu\Exception
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function desktop(MenuManager $main_menu)
    {
//        dump($main_menu);

        dump($main_menu->getStructure());

        return $this->render('@AplabAdmin/admin.html.twig', get_defined_vars());
    }
}