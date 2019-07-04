<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Event;
use App\Form\MemberCommentType;
use App\Repository\EventRepository;
use App\Repository\GaleryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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

    /** @param Event $event
     * @Route("/event_to_come/{id}", name="show_event_to_come", methods={"GET"})
     * @return Response
     */
    public function showOneEventById(Event $event): Response
    {
        return $this->render('member/show_event_to_come.html.twig', [
            'event' => $event,
        ]);
    }

    /**
     * @param Request $request
     * @Route("/new", name="show_event_to_come", methods={"GET","POST"})
     * @return Response
     */
    public function newMemberComment(Request $request): Response
    {
        $commentMember = new Comment();
        $form = $this->createForm(MemberCommentType::class, $commentMember);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentMember);
            $entityManager->flush();

            return $this->redirectToRoute('show_event_to_come');
        }

        return $this->render('member/show_event_to_come.html.twig', [
            'commentMember' => $commentMember,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/page/", name="member_page")
     * @return Response
     */
    public function index(): Response
    {
        $user=$this->getUser();
        return $this->render('member_page/index.html.twig', [

            'user' => $user,
        ]);
    }


    /**
     * @Route("/galery", name="member_galery")
     * @param GaleryRepository $galeryRepository
     * @return Response
     */
    public function galery(GaleryRepository $galeryRepository): Response
    {
        return $this->render('private_galery/index.html.twig', [
            'galery' => $galeryRepository->findAll(),
        ]);
    }
}
