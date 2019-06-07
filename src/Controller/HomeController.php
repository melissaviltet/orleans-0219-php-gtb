<?php

namespace App\Controller;

use App\Repository\SponsorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @param SponsorRepository $sponsorRepository
     * @Route("/", name="home")
     * @return Response
     */
    public function index(SponsorRepository $sponsorRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'sponsors' => $sponsorRepository->findAll(),
        ]);
    }
}
