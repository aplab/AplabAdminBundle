<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 06.08.2018
 * Time: 10:31
 */

namespace Aplab\AplabAdminBundle\Controller;


use Aplab\AplabAdminBundle\Component\Menu\Menu;
use Aplab\AplabAdminBundle\Component\Menu\MenuManager;
use Aplab\AplabAdminBundle\Component\ModuleMetadata\ModuleMetadataRepository;
use Aplab\AplabAdminBundle\Entity\SampleEntity;
use Aplab\AplabAdminBundle\Repository\SampleEntityRepository;
use Aplab\AplabAdminBundle\Tools\Tools;
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
     * @param SampleEntityRepository $repository
     * @param ModuleMetadataRepository $mdr
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \ReflectionException
     */
    public function desktop(SampleEntityRepository $repository, ModuleMetadataRepository $mdr)
    {
        $count = $repository->count([]);
        $count2 = $repository->count([]);
        $items = $repository->findAll();
        $items2 = $repository->findBy([], ['id' => 'DESC'], 3, 2);
        $md = $mdr->getMetadata(SampleEntity::class);
        return $this->render('@AplabAdmin/admin.html.twig', get_defined_vars());
    }
}