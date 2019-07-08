<?php


namespace App\Services;

use App\Repository\UserRepository;

class MembersGetting
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function sortMembers(): array
    {
        $members = [];
        $users = $this->userRepository->findBy([], ['lastname'=>'ASC', 'firstname'=>'ASC']);
        foreach ($users as $user) {
            if (in_array('ROLE_PRESIDENT', $user->getRoles())) {
                $members['president'][] = $user;
            } elseif (in_array('ROLE_OFFICE', $user->getRoles())) {
                $members['office'][] = $user;
            } elseif (in_array('ROLE_MEMBER', $user->getRoles())) {
                $members['member'][] = $user;
            }
        }
        return $members;
    }
}
