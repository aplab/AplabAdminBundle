<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 25.08.2018
 * Time: 17:56
 */

namespace Aplab\AplabAdminBundle\Controller;


use Aplab\AplabAdminBundle\Entity\SystemUser;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NamedTimestampableController
 * @package Aplab\AplabAdminBundle\Controller
 * @Route("/admin/system-user", name="admin_system_user_")
 */
class SystemUserController extends ReferenceAdminController
{
    /**
     * @var string
     */
    protected $entityClassName = SystemUser::class;
}