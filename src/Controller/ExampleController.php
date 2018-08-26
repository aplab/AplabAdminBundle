<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 26.08.2018
 * Time: 14:58
 */

namespace Aplab\AplabAdminBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ExampleController
 * @package Aplab\AplabAdminBundle\Controller
 * @Route("/admin", name="admin_")
 */
class ExampleController extends BaseAdminController
{
    /**
     * @Route("/test", name="test")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function test() {
        return $this->render('@AplabAdmin/admin.html.twig', get_defined_vars());
    }
}