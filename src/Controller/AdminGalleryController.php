<?php


namespace App\Controller;

use App\Repository\GaleryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminGalleryController extends AbstractController
{
    /**
     * @param GaleryRepository $galeryRepository
     * @Route("/admin/gallery", name="admin_gallery")
     * @return Response
     */
    public function showAll(GaleryRepository $galeryRepository): Response
    {
        return $this->render('admin/galery.html.twig', [
            'gallery' => $galeryRepository->findAll()
        ]);
    }
}
