<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Swift_Mailer;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact", methods={"GET","POST"})
     */
    public function index(Request $request, Swift_Mailer $mailer): Response
    {

        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mailContent = $this->renderView(
                'contact/email.html.twig',
                array('contact' => $contact)
            );

            $currentCategory = '';
            foreach (Contact::SUBJECTS as $category => $subjects) {
                if (in_array($contact->getSubject(), $subjects)) {
                    $currentCategory = $category;
                }
            }


            $message = (new Swift_Message())
                ->setSubject($contact->getSubject())
                ->setFrom($this->getParameter('mailer_from'))
                ->setTo($this->getParameter('mailer_from_' . $currentCategory))
                ->setReplyTo($contact->getEmail())
                ->setBody($mailContent, 'text/html');

            $mailer->send($message);


            return $this->redirectToRoute('home');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
