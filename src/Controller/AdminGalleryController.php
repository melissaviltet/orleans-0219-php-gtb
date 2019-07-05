<?php


namespace App\Controller;

use App\Entity\Galery;
use App\Form\GalleryType;
use App\Repository\GaleryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminGalleryController extends AbstractController
{
    /**
     * @param GaleryRepository $galeryRepository
     * @Route("/admin/gallery", name="admin_gallery")
     * @return Response
     */
    public function showAll(GaleryRepository $galeryRepository): Response
    {
        return $this->render('admin/gallery.html.twig', [
            'gallery' => $galeryRepository->findAll()
        ]);
    }

    /**
     * @param Request $request
     * @param GaleryRepository $galeryRepository
     * @Route("/admin/gallery", name="admin_gallery", methods={"GET","POST"})
     * @return Response
     */
    public function new(Request $request, GaleryRepository $galeryRepository): Response
    {
        $gallery = new Galery();
        $form = $this->createForm(GalleryType::class, $gallery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($gallery);
            $entityManager->flush();

            return $this->redirectToRoute('admin_gallery');
        }
        return $this->render('admin/gallery.html.twig', [
            'gallery' => $galeryRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param Galery $galery
     * @Route("/admin/gallery/{id}", name="gallery_delete", methods={"DELETE"})
     * @return Response
     */
    public function deleteSponsor(Request $request, Galery $galery): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($galery);
        $em->flush();

        return new Response(null, 200);
    }
}
