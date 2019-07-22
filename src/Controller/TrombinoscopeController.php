<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Services\MembersGetting;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TrombinoscopeController extends AbstractController
{
    /**
     * @Route("/trombinoscope", name="trombinoscope")
     */
    public function index(UserRepository $userRepository)
    {
        $user = $this->getUser();
        $users = $userRepository->findMembers();

        foreach (User::ROLES as $status => $role) {
            foreach ($users as $user) {
                if ($user->getStatus() == $status) {
                    if (in_array('ROLE_PRESIDENT', $user->getRoles())) {
                        $status = 'Présidents';
                    }

                    $trombinoscopeUsers[$status][] = $user;
                }
            }
        }


        return $this->render('trombinoscope/index.html.twig', [
            'trombinoscodeUsers' => $trombinoscopeUsers ?? [],
            'user' => $user,
        ]);
    }
}
