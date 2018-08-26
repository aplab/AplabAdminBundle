<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 06.08.2018
 * Time: 10:31
 */

namespace Aplab\AplabAdminBundle\Controller;

use Aplab\AplabAdminBundle\Component\Menu\MenuManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @package Aplab\AplabAdminBundle\Controller
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    protected $masterRequest;

    public function __construct(RequestStack $masterRequest)
    {
        dump($masterRequest->getMasterRequest());
    }

    /**
     * @Route("/", name="desktop")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function desktop() {
        return $this->render('@AplabAdmin/admin.html.twig', get_defined_vars());
    }

    /**
     * @Route("/test", name="test")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function test() {
        return $this->render('@AplabAdmin/admin.html.twig', get_defined_vars());
    }
}