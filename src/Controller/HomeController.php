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

     /** @param SponsorRepository $sponsorRepository, AssociationRepository $association, EventRepository $eventRepository
     * @Route("/", name="home")
     * @return Response
     */
    public function index(SponsorRepository $sponsorRepository, AssociationRepository $association, EventRepository $eventRepository): Response
    {
        $first = $eventRepository->findBy([], ['date'=>'DESC'], 1);
        dd($first);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'first' => $first,
            'sponsors' => $sponsorRepository->findAll(),
            'association' => $association->findOneBy(['id' => 1]),
        ]);
    }
}
