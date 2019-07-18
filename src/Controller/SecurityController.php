<?php

namespace App\Controller;

use App\Form\ChangePasswordFormType;
use Swift_Mailer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use App\Service\TokenService;
use App\Form\ForgottenPasswordType;

class SecurityController extends AbstractController
{
    /**
     * @param AuthenticationUtils $authenticationUtils
     * @param Request $request
     * @Route("/login", name="app_login")
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        $user=$this->getUser();

        if ($error) {
            $this->addFlash('login', 'Error Login');
        }

        if (true === $this->get('security.authorization_checker')->isGranted('ROLE_MEMBER')) {
            return $this->redirectToRoute('member_page');
        }

        if (true === $this->get('security.authorization_checker')->isGranted('ROLE_OFFICE')
            || true === $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('admin');
        }

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'user' => $user,]);
    }


    /**
     * @Route("/reset/password", name="forgotten_password")
     */
    public function forgottenPassword(
        Request $request,
        Swift_Mailer $mailer,
        TokenService $tokenService
    ): Response {
        $user=$this->getUser();
        $form = $this->createForm(ForgottenPasswordType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $username = $form->getData()['email'];
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->findOneByEmail($username);
            if ($user === null) {
                $this->addFlash('danger', 'Email invalide');
                return $this->redirectToRoute('forgotten_password');
            }
            $token = $tokenService->generate($username);
            $url = $this->generateUrl(
                'app_reset_password',
                ['token' => $token,
                ],
                UrlGeneratorInterface::ABSOLUTE_URL
            );
            $message = (new \Swift_Message('Récupération de votre mot de passe'))
                ->setFrom($this->getParameter('mailer_from_trail'))
                ->setTo($user->getEmail())
                ->setBody(
                    "Cliquer sur le lien pour réinitialiser votre mot de passe " . $url,
                    'text/html'
                );
            $mailer->send($message);
            $this->addFlash('notice', 'Votre demande a bien été prise en compte.
             Vous allez recevoir un mail permettant de réinitialiser votre mot de passe à l\'adresse indiquée.');
            return $this->redirectToRoute('app_login');
        }
        return $this->render('security/resetPassword.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }

    /**
     * @Route("/reset_password/{token}", name="app_reset_password")
     */
    public function resetPassword(
        Request $request,
        string $token,
        UserPasswordEncoderInterface $passwordEncoder,
        TokenService $tokenService
    ) {
        $user=$this->getUser();
        $form = $this->createForm(ChangePasswordFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Nouveau pot de passe crée !');
            $username = $form->getData()['email'];
            if (!$tokenService->isValid($token, $username)) {
                $this->addFlash('danger', 'Lien invalide');
                return $this->redirectToRoute('app_login');
            }
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->findOneByEmail($username);
            $user->setPassword($passwordEncoder->encodePassword($user, $form->getData()['password']));
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('updated-password', 'Mot de passe mis à jour');
            return $this->redirectToRoute('app_login');
        } else {
            return $this->render('security/changePassword.html.twig', [
                'form' => $form->createView(),
                'user' => $user
            ]);
        }
    }
}
