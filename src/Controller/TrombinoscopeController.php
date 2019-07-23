<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Services\MembersGetting;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TrombinoscopeController extends AbstractController
{
    const ROLE_STATUSES = [
        'ROLE_PRESIDENT' => 'Présidents',
        'ROLE_OFFICE'    => 'Bureau',
        'ROLE_SPORTS'    => 'Encadrants Sportifs',
        'ROLE_MEMBER'    => 'Membres',
    ];

    /**
     * @Route("/trombinoscope", name="trombinoscope")
     */
    public function index(UserRepository $userRepository)
    {
        $user = $this->getUser();
        $users = $userRepository->findMembers();

        foreach (self::ROLE_STATUSES as $role => $roleLabel) {
            foreach ($users as $user) {
                if (in_array($role, $user->getRoles())) {
                    $trombinoscopeUsers[$roleLabel][] = $user;
                }
            }
        }


        return $this->render('trombinoscope/index.html.twig', [
            'trombinoscodeUsers' => $trombinoscopeUsers ?? [],
            'user'               => $user,
        ]);
    }
}
