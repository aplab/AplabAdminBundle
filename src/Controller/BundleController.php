<?php

namespace Aplab\AplabAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BundleController extends AbstractController
{
    /**
     * @return mixed
     * @Route ("/admin/test", name="test")
     */
    public function test()
    {
        return $this->render('@AplabAdmin/test.html.twig');
    }
}
