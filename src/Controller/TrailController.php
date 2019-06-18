<?php

namespace App\Controller;

use App\Repository\AssociationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TrailController extends AbstractController
{
    /**
     * @param AssociationRepository $associationRepository
     * @Route("/trail", name="trail")
     * @return Response
     */
    public function trail(AssociationRepository $associationRepository): Response
    {
        return $this->render('trail/index.html.twig', [
            'association' => $associationRepository->findOneBy([]),
        ]);
    }

    /**
     * @param AssociationRepository $associationRepository
     * @Route("/triathlon", name="triathlon")
     * @return Response
     */
    public function triathlon(AssociationRepository $associationRepository): Response
    {
        return $this->render('triathlon/index.html.twig', [
            'association' => $associationRepository->findOneBy([]),
        ]);
    }
}
