<?php

namespace App\Controller;

use App\Repository\AssociationRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClubController extends AbstractController
{
    /**
     * @param UserRepository $userRepository
     * @param AssociationRepository $associationRepository
     * @Route("/club", name="club")
     * @return Response
     */
    public function show(AssociationRepository $associationRepository, UserRepository $userRepository): Response
    {
        return $this->render('club/index.html.twig', [
            'association' => $associationRepository->findOneBy([]),
            'user' => $userRepository->findOneBy([])
        ]);
    }
}
