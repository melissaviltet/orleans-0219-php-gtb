<?php

namespace App\Controller;

use App\Repository\EventRepository;
use App\Repository\AssociationRepository;
use App\Repository\SponsorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /** @param SponsorRepository $sponsorRepository
     * @param AssociationRepository $association
     * @param EventRepository $eventRepository
     * @Route("/", name="home")
     * @return Response
     */
    public function index(
        SponsorRepository $sponsorRepository,
        AssociationRepository $association,
        EventRepository $eventRepository
    ): Response {
        $eventsBrut = $eventRepository->findBy([], ['date' => 'ASC'], 4);
        $first = $eventsBrut[0];
        $events=[];
        for ($i=1; $i <4; $i++) {
            $events[$i-1] = $eventsBrut[$i];
        }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'first' => $first,
            'events' => $events,
            'sponsors' => $sponsorRepository->findAll(),
            'association' => $association->findOneBy([]),
        ]);
    }
}
