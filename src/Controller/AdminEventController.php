<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/admin/event")
 * @IsGranted({"ROLE_ADMIN", "ROLE_OFFICE", "ROLE_PRESIDENT"}, message="Accès réservé aux Administrateurs")
 */
class AdminEventController extends AbstractController
{
    /**
     * @param EventRepository $eventRepository
     * @Route("/", name="event_index", methods={"GET"})
     * @return Response
     */
    public function index(EventRepository $eventRepository): Response
    {
        return $this->render('event/index.html.twig', [
            'events' => $eventRepository->findBy([], ['date' => 'ASC']),
            'titleHeader' => 'Evenements',
        ]);
    }

    /**
     * @param Request $request
     * @Route("/new", name="event_new", methods={"GET","POST"})
     * @return Response
     */
    public function new(Request $request): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $event->setDate(new \DateTime());
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('event_index');
        }

        return $this->render('event/new.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
            'titleHeader' => 'Ajouter un evenement'
        ]);
    }


    /**
     * @param Request $request
     * @param Event $event
     * @Route("/{id}/edit", name="event_edit", methods={"GET","POST"})
     * @return Response
     */
    public function edit(Request $request, Event $event): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('event_index', [
                'id' => $event->getId(),
            ]);
        }


        return $this->render('event/edit.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
            'titleHeader' => 'Modifier l\'evenement'
        ]);
    }

    /**
     * @param Request $request
     * @param Event $event
     * @Route("/{id}", name="event_delete", methods={"DELETE"})
     * @return Response
     */
    public function delete(Request $request, Event $event): Response
    {
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($event);
            $entityManager->flush();
        }

        return $this->redirectToRoute('event_index');
    }
}
