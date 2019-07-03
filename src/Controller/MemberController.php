<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MemberController
 * @package App\Controller
 * @Route("/member")
 */
class MemberController extends AbstractController
{
    /**
     * @param EventRepository $eventRepository
     * @Route("/event_to_come", name="member_event_to_come")
     * @return Response
     */
    public function showEventsToCome(EventRepository $eventRepository): Response
    {
        return $this->render('member/event_to_come.html.twig', [
            'events' => $eventRepository->findBy(['isPrivate' => true], ['date' => 'ASC'], 6)
        ]);
    }

    /**
     * @param Event $event
     * @Route("/event_to_come/{id}", name="show_event_to_come", methods={"GET"})
     * @return Response
     */
    public function showOneEventById(Event $event): Response
    {
        return $this->render('member/show_event_to_come.html.twig', [
            'event' => $event,
        ]);
    }
}
