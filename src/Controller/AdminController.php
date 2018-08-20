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
use Doctrine\ORM\EntityManagerInterface;
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
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \ReflectionException
     */
    public function desktop(
        NamedTimestampableRepository $repository,
        ModuleMetadataRepository $mdr,
        EntityManagerInterface $em)
    {
//        $count = $repository->count([]);
//        $items = $repository->findAll();
//        $items2 = $repository->findBy([], ['id' => 'DESC'], 3, 2);

//        dump($repository);

        $md = $mdr->getMetadata(NamedTimestampable::class);
        $item = new NamedTimestampable;
//        $item->setName(bin2hex(random_bytes(10)));

        $item = $repository->find(12);
        $item->setName(rand(10, 20));

        $r2 = $em->getRepository(NamedTimestampable::class);
//        dump($r2);
        $meta = $em->getClassMetadata(NamedTimestampable::class);
        $em->persist($item);
        $em->flush();

        return $this->render('@AplabAdmin/admin.html.twig', get_defined_vars());
    }
}