<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 04.09.2018
 * Time: 14:25
 */

namespace Aplab\AplabAdminBundle\Controller;


use Aplab\AplabAdminBundle\Component\FileStorage\LocalStorage;
use Aplab\AplabAdminBundle\Component\Uploader\ImageUploader;
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
     * @param LocalStorage $localStorage
     * @return JsonResponse
     */
    public function uploadImage(LocalStorage $localStorage)
    {
        $uploader = new ImageUploader($localStorage);
        try {
            $url = $uploader->receive();
            return new JsonResponse([
                'status' => 'ok',
                'url' => $url
            ]);
        } catch (\Throwable $exception) {
            return new JsonResponse([
                'message' => $exception->getMessage(),
                'code' => $exception->getCode()
            ]);
        }
    }
}