<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 25.08.2018
 * Time: 17:56
 */

namespace Aplab\AplabAdminBundle\Controller;


use Aplab\AplabAdminBundle\Component\DataTableRepresentation\DataTableRepresentation;
use Aplab\AplabAdminBundle\Component\InstanceEditor\InstatceEditorManager;
use Aplab\AplabAdminBundle\Entity\NamedTimestampable;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class NamedTimestampableController
 * @package Aplab\AplabAdminBundle\Controller
 * @Route("/admin/named-timestampable", name="admin_named_timestampable_")
 */
class NamedTimestampableController extends ReferenceAdminController
{
    /**
     * @var string
     */
    protected $entityClassName = NamedTimestampable::class;
}