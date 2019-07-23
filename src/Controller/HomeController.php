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
     * @param AssociationRepository $associationRepository
     * @param EventRepository $eventRepository
     * @Route("/", name="home")
     * @return Response
     */
    public function index(
        SponsorRepository $sponsorRepository,
        AssociationRepository $associationRepository,
        GaleryRepository $picture,
        EventRepository $eventRepository
    ): Response {
        $user=$this->getUser();
        $events = $eventRepository->findBy(['isPrivate'=>false], ['date' => 'DESC'], 4);
        return $this->render('home/index.html.twig', [
            'events' => $events,
            'sponsors' => $sponsorRepository->findAll(),
            'association' => $associationRepository->findOneBy([]),
            'pictures' => $picture->findBy(['private' => false], null, 12),
            'user' => $user

        ]);
    }
}
