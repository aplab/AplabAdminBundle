<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 06.08.2018
 * Time: 10:31
 */

namespace Aplab\AplabAdminBundle\Controller;


use Capsule\Util\CapsuleCmsUiDataTransmitter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @package Capsule\Controller
 * @Route("/admin", name="admin_")
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="desktop")
     */
    public function desktop()
    {
        return $this->render('@AplabAdmin/admin.html.twig', get_defined_vars());
    }
}