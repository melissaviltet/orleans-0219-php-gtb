<?php

namespace App\Controller;

use App\Repository\EventRepository;
use App\Repository\AssociationRepository;
use App\Repository\GaleryRepository;
use App\Repository\SponsorRepository;
use App\Repository\UserRepository;
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
     * @param UserRepository $userRepository
     * @Route("/", name="home")
     * @return Response
     */
    public function index(
        SponsorRepository $sponsorRepository,
        AssociationRepository $associationRepository,
        GaleryRepository $picture,
        EventRepository $eventRepository,
        UserRepository $userRepository
    ): Response {
        $events = $eventRepository->findBy([], ['date' => 'ASC'], 4);
        return $this->render('home/index.html.twig', [
            'events' => $events,
            'sponsors' => $sponsorRepository->findAll(),
            'association' => $associationRepository->findOneBy([]),
            'pictures' => $picture->findAll(),
            'user' => $userRepository->findOneBy([])

        ]);
    }
}
