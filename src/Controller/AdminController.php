<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 06.08.2018
 * Time: 10:31
 */

namespace Aplab\AplabAdminBundle\Controller;


use Aplab\AplabAdminBundle\Component\ModuleMetadata\ModuleMetadataRepository;
use Aplab\AplabAdminBundle\Entity\NamedTimestampable;
use Aplab\AplabAdminBundle\Repository\NamedTimestampableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @package Aplab\AplabAdminBundle\Controller
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="desktop")
     * @param NamedTimestampableRepository $repository
     * @param ModuleMetadataRepository $mdr
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function desktop(NamedTimestampableRepository $repository, ModuleMetadataRepository $mdr)
    {
//        $count = $repository->count([]);
//        $items = $repository->findAll();
//        $items2 = $repository->findBy([], ['id' => 'DESC'], 3, 2);

//        $md = $mdr->getMetadata(NamedTimestampable::class);
        $item = new NamedTimestampable;
//        $item->setName(bin2hex(random_bytes(10)));

        $item = $repository->find(12);
        $item->setName(rand(10, 20));

        $em = $this->getDoctrine()->getManager();
        $em->persist($item);
        $em->flush();

        return $this->render('@AplabAdmin/admin.html.twig', get_defined_vars());
    }
}