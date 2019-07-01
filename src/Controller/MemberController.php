<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MemberController extends AbstractController
{
    /**
     * @Route("/member", name="member")
     */
    public function index()
    {
        return $this->render('member/index.html.twig', [
            'controller_name' => 'MemberController',
        ]);
    }

    /**
     * @param EventRepository $eventRepository
     * @Route("/member/event_to_come", name="member_event_to_come")
     * @return Response
     */
    public function showEventsToCome(EventRepository $eventRepository): Response
    {
        return $this->render('member/event_to_come.html.twig', [
            'events' => $eventRepository->findBy(['isPrivate' => true], ['date' => 'ASC'], 6)
        ]);
    }
}
