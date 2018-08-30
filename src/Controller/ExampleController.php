<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 26.08.2018
 * Time: 14:58
 */

namespace Aplab\AplabAdminBundle\Controller;


use Aplab\AplabAdminBundle\Entity\NamedTimestampable;
use Doctrine\Common\Inflector\Inflector;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Class ExampleController
 * @package Aplab\AplabAdminBundle\Controller
 * @Route("/admin", name="admin_")
 */
class ExampleController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function test(Request $request) {

        $form = $this->createFormBuilder()
            ->add('task', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();

        $form = $form->createView();

        dump(Inflector::tableize(NamedTimestampable::class));

        return $this->render('@AplabAdmin/admin-test.html.twig', get_defined_vars());
    }
}