<?php

namespace App\Controller;

use App\Entity\Association;
use App\Form\AssociationType;
use App\Repository\AssociationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/association")
 */
class AdminAssociationController extends AbstractController
{
    /**
     * @Route("/show", name="association_show")
     */
    public function show(AssociationRepository $associationRepository): Response
    {
        return $this->render('association/show.html.twig', [
            'association' => $associationRepository->findOneBy([]),
        ]);
    }

    /**
     * @Route("/edit", name="association_edit", methods={"POST"})
     */
    public function edit(Request $request, Association $association): Response
    {
        $form = $this->createForm(AssociationType::class, $association);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('association_index', [
                'id' => $association->getId(),
            ]);
        }

        return $this->render('association/edit.html.twig', [
            'association' => $association,
            'form' => $form->createView(),
        ]);
    }
}
