<?php

namespace App\Controller;

use App\Services\MembersGetting;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TrombinoscopeController extends AbstractController
{
    /**
     * @Route("/trombinoscope", name="trombinoscope")
     */
    public function index(MembersGetting $membersGetting)
    {
        return $this->render('trombinoscope/index.html.twig', [
            'members' => $membersGetting->sortMembers(),
        ]);
    }
}
