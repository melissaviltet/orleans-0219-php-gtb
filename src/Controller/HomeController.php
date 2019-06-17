<?php

namespace App\Controller;

use App\Repository\AssociationRepository;
use App\Repository\GaleryRepository;
use App\Repository\SponsorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @param GaleryRepository $picture
     * @param SponsorRepository $sponsorRepository
     * @param AssociationRepository $association
     * @Route("/", name="home")
     * @return Response
     */
    public function index(
        SponsorRepository $sponsorRepository,
        AssociationRepository $association,
        GaleryRepository $picture
    ): Response {
        return $this->render('home/index.html.twig', [
            'sponsors' => $sponsorRepository->findAll(),
            'association' => $association->findOneBy([]),
            'pictures' => $picture->findAll()
        ]);
    }
}
