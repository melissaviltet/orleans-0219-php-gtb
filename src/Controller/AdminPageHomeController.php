<?php

namespace App\Controller;

use App\Entity\Sponsor;
use App\Form\SponsorType;
use App\Repository\SponsorRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminPageHomeController
 * @IsGranted({"ROLE_ADMIN", "ROLE_PRESIDENT"}, message="Accès réservé aux Administrateurs")
 */
class AdminPageHomeController extends AbstractController
{
    /**
     * @param SponsorRepository $sponsorRepository
     * @Route("/admin/page_home", name="admin_page_home")
     * @return Response
     */
    public function index(SponsorRepository $sponsorRepository) : Response
    {
        return $this->render('admin/page_home.html.twig', [
            'sponsors' => $sponsorRepository->findAll(),
        ]);
    }

    /**
     * @param Request $request
     * @param SponsorRepository $sponsorRepository
     * @Route("/admin/page_home", name="admin_page_home", methods={"GET","POST"})
     * @return Response
     */
    public function new(Request $request, SponsorRepository $sponsorRepository): Response
    {
        $sponsor = new Sponsor();
        $form = $this->createForm(SponsorType::class, $sponsor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sponsor);
            $entityManager->flush();

            return $this->redirectToRoute('admin_page_home');
        }

        return $this->render('admin/page_home.html.twig', [
            'sponsors' => $sponsorRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param Sponsor $sponsor
     * @Route("/sponsor/{id}", name="sponsor_delete", methods={"DELETE"})
     * @return Response
     */
    public function deleteSponsor(Request $request, Sponsor $sponsor): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($sponsor);
        $em->flush();

        return new Response(null, 200);
    }
}
