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
use Aplab\AplabAdminBundle\Entity\HistoryUploadImage;
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
        $entity_manager = $this->getDoctrine()->getManager();
        $uploader = new ImageUploader($localStorage, $entity_manager);
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

    /**
     * @Route("/historyUploadImage/listItems/{offset}/",
     *     name="history_upload_image_list_items", methods="GET",
     *     requirements={"offset"="^\d+$"})
     * @param int $offset
     * @return JsonResponse
     */
    public function historyUploadImageListItems($offset)
    {
        $items = $this->getDoctrine()->getRepository(HistoryUploadImage::class)->findBy(
            [],
            ['favorites' => 'DESC', 'id' => 'desc'],
            103, $offset
        );
        return new JsonResponse($items);
    }
}