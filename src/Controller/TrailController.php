<?php

namespace App\Controller;

use App\Repository\AssociationRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TrailController extends AbstractController
{
    /**
     * @param UserRepository $userRepository
     * @param AssociationRepository $associationRepository
     * @Route("/trail", name="trail")
     * @return Response
     */
    public function show(AssociationRepository $associationRepository, UserRepository $userRepository): Response
    {
        return $this->render('trail/index.html.twig', [
            'association' => $associationRepository->findOneBy([]),
            'user' => $userRepository->findOneBy([])
        ]);
    }
}
