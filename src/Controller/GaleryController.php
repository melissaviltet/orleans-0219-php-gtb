<?php

namespace App\Controller;

use App\Repository\GaleryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GaleryController extends AbstractController
{
    /**
     * @param GaleryRepository $galeryRepository
     * @Route("/galery", name="galery")
     * @return Response
     */
    public function index(GaleryRepository $galeryRepository): Response
    {
        return $this->render('galery/index.html.twig', [
            'galery' => $galeryRepository->findBy(['private' => false])
        ]);
    }
}
