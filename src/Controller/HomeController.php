<?php

namespace App\Controller;

use App\Repository\PictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @param PictureRepository $pictureRepository
     * @Route("/", name="home")
     * @return Response
     */
    public function index(PictureRepository $pictureRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'pictures' => $pictureRepository->findAll(),
        ]);
    }
}
