<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 04.09.2018
 * Time: 14:25
 */

namespace Aplab\AplabAdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FileController
 * @package Aplab\AplabAdminBundle\Controller
 * @Route("/admin/xhr", name="admin_xhr_")
 */
class XhrController extends Controller
{
    /**
     * @Route("/uploadImage/", name="upload_image", methods="POST")
     */
    public function uploadImage()
    {
        return new JsonResponse(['status' => 'ok']);
    }
}