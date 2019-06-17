<?php

namespace App\Controller;

use App\Repository\EventRepository;
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
     * @param EventRepository $eventRepository

     * @Route("/", name="home")
     * @return Response
     */
    public function index(
        SponsorRepository $sponsorRepository,
        AssociationRepository $association,
        GaleryRepository $picture,
        EventRepository $eventRepository
    ): Response {
               $events = $eventRepository->findBy([], ['date' => 'ASC'], 4);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'events' => $events,
            'sponsors' => $sponsorRepository->findAll(),
            'association' => $associationRepository->findOneBy([]),
            'pictures' => $picture->findAll()

        ]);
    }
}
