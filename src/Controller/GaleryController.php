<?php

namespace App\Controller;

use App\Repository\GaleryRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GaleryController extends AbstractController
{
    /**
     * @param UserRepository $userRepository
     * @param GaleryRepository $galeryRepository
     * @Route("/galery", name="galery")
     * @return Response
     */
    public function index(GaleryRepository $galeryRepository, UserRepository $userRepository): Response
    {
        return $this->render('galery/index.html.twig', [
            'galery' => $galeryRepository->findBy(['private' => false]),
            'user' => $userRepository->findOneBy([])
        ]);
    }

    /**
     * @param UserRepository $userRepository
     * @param GaleryRepository $galeryRepository
     * @Route("/admin/galery", name="admin_galery")
     * @return Response
     */
    public function showAll(GaleryRepository $galeryRepository, UserRepository $userRepository): Response
    {
        return $this->render('admin/galery.html.twig', [
            'galery' => $galeryRepository->findAll(),
            'user' => $userRepository->findOneBy([])
        ]);
    }
}
