<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 26.08.2018
 * Time: 14:58
 */

namespace Aplab\AplabAdminBundle\Controller;


use Aplab\AplabAdminBundle\Entity\AdjacencyList\ListItem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ExampleController
 * @package Aplab\AplabAdminBundle\Controller
 * @Route("/admin", name="admin_")
 */
class ExampleController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function test() {

        $em = $this->getDoctrine()->getManager();
        $repo = $this->getDoctrine()->getRepository(ListItem::class);
//        $root = $repo->find(2);
        $child = $repo->find(1);
//        $root->addChild($child);
//
//        $em->flush();
        dump($child);
        dump($child->getParent()->getChildren()->first()->getParent());




        return $this->render('@AplabAdmin/admin-test.html.twig', get_defined_vars());
    }
}