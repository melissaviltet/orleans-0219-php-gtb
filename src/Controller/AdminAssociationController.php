<?php

namespace App\Controller;

use App\Entity\Association;
use App\Form\Association1Type;
use App\Repository\AssociationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/association")
 * @IsGranted({"ROLE_ADMIN"}, message="Accès réservé aux Administrateurs")
 */
class AdminAssociationController extends AbstractController
{
    /**
     * @Route("/", name="association_index", methods={"GET"})
     */
    public function index(AssociationRepository $associationRepository): Response
    {
        return $this->render('association/index.html.twig', [
            'association' => $associationRepository->findOneBy([]),
            'titleHeader' => 'Pages Trail et Triathlon'
        ]);
    }

    /**
     * @Route("/{id}", name="association_show", methods={"GET"})
     */
    public function show(Association $association): Response
    {
        return $this->render('association/show.html.twig', [
            'association' => $association,
        ]);
    }

    /**
     * @param Request $request
     * @param Association $association
     * @Route("/{id}/edit", name="association_edit", methods={"GET","POST"})
     * @return Response
     */
    public function edit(Request $request, Association $association): Response
    {
        $form = $this->createForm(Association1Type::class, $association);
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
            'titleHeader' => 'Editer les pages',
        ]);
    }

    /**
     * @param Request $request
     * @param Association $association
     * @Route("/{id}", name="association_delete", methods={"DELETE"})
     * @return Response
     */
    public function delete(Request $request, Association $association): Response
    {
        if ($this->isCsrfTokenValid('delete'.$association->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($association);
            $entityManager->flush();
        }
        return $this->redirectToRoute('association_index');
    }
}
