<?php

namespace App\Controller;

use App\Repository\AssociationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TriathlonController extends AbstractController
{

    /**
     * @param AssociationRepository $associationRepository
     * @Route("/triathlon", name="triathlon")
     * @return Response
     */
    public function show(AssociationRepository $associationRepository): Response
    {
        $user=$this->getUser();
        return $this->render('triathlon/index.html.twig', [
            'association' => $associationRepository->findOneBy([]),
            'user' => $user
        ]);
    }
}
