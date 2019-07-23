<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AdminUserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/admin/user", name="admin_")
 * @IsGranted({"ROLE_ADMIN"}, message="Accès réservé aux Administrateurs")
 */
class AdminUserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET","POST"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findBy([], ['roles' => 'ASC', 'lastname' => 'ASC', 'firstname' => 'ASC']),
        ]);
    }


    /**
     * @param Request $request
     * @param User $user
     * @param Security $security
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     * @return Response
     */
    public function edit(
        Request $request,
        User $user,
        Security $security,
        EntityManagerInterface $entityManager
    ): Response {
        $form = $this->createForm(AdminUserType::class, $user);
        $form->handleRequest($request);

        if ($security->isGranted('ROLE_ADMIN')) {
            if ($form->isSubmitted() && $form->isValid()) {
                $role = User::ROLES[$user->getStatus()];
                $user->setRoles([$role]);
                $entityManager->flush();
                $user->setImageFile(null);
                return $this->redirectToRoute('user_index', [
                    'id' => $user->getId(),
                ]);
            }
        } else {
            $this->denyAccessUnlessGranted('EDIT', $user, 'Action réservée aux Administrateurs');
        }
        return $this->render('user/editAdmin.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @param Security $security
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     * @return Response
     */
    public function delete(Request $request, User $user, Security $security): Response
    {
        if ($security->isGranted('ROLE_ADMIN')) {
            if (in_array('ROLE_ADMIN', $user->getRoles())) {
                $this->addFlash('danger', 'Impossible de supprimer un utilisateur Administrateur');
            } elseif ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($user);
                $entityManager->flush();
            }
        } else {
            $this->denyAccessUnlessGranted('DELETE', $user, 'Action réservée aux Administrateurs');
        }
        return $this->redirectToRoute('user_index');
    }
}
