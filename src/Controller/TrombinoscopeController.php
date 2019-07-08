<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Services\MembersGetting;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TrombinoscopeController extends AbstractController
{
    /**
     * @param UserRepository $userRepository
     * @Route("/trombinoscope", name="trombinoscope")
     */
    public function index(MembersGetting $membersGetting, UserRepository $userRepository)
    {
        return $this->render('trombinoscope/index.html.twig', [
            'members' => $membersGetting->sortMembers(),
            'user' => $userRepository->findOneBy([])
        ]);
    }
}
