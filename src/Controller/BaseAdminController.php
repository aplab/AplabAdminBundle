<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 26.08.2018
 * Time: 15:00
 */

namespace Aplab\AplabAdminBundle\Controller;


use Aplab\AplabAdminBundle\Component\Helper\AdminControllerHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class BaseAdminController
 * @package Aplab\AplabAdminBundle\Controller
 */
abstract class BaseAdminController extends AbstractController
{
    /**
     * @var AdminControllerHelper
     */
    protected $adminControllerHelper;

    /**
     * BaseAdminController constructor.
     * @param AdminControllerHelper $adminControllerHelper
     */
    final public function __construct(AdminControllerHelper $adminControllerHelper)
    {
        $this->adminControllerHelper = $adminControllerHelper;
        if (!isset($this->entityClassName)) {
            throw new \LogicException(get_class($this) . ' must have a protected $entityClassName = Entity::class');
        }
    }

    /**
     * @return mixed
     */
    public function getEntityClassName() {
        /** @noinspection PhpUndefinedFieldInspection */
        return $this->entityClassName;
    }
}