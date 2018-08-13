<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 06.08.2018
 * Time: 10:31
 */

namespace Aplab\AplabAdminBundle\Controller;


use Aplab\AplabAdminBundle\Service\MainMenu;
use Aplab\AplabAdminBundle\Util\Path;
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
     */
    public function desktop(Path $path, MainMenu $menu)
    {
        $para = $this->container->getParameter('mainmenu.structurelocation');
        dd($para);
        return $this->render('@AplabAdmin/admin.html.twig', get_defined_vars());
    }
}