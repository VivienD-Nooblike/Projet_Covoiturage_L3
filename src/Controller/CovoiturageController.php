<?php

namespace App\Controller;

use App\Entity\Covoiturage;
use App\Form\CovoiturageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CovoiturageController extends AbstractController
{
    /**
     * Lister tous les covoiturages.
     * @Route("/covoiturage/", name="covoiturage.list")
     * @return Response
     */
    public function list(): Response
    {
        $covoiturages = $this->getDoctrine()->getRepository(Covoiturage::class)->getCovoituragesNonExpires();

        return $this->render('covoiturage/list.html.twig', [
            'covoiturages' => $covoiturages,
        ]);
    }

    /**
     * Chercher et afficher un covoiturage.
     * @Route("/covoiturage/{slug}", name="covoiturage.show")
     * @param Covoiturage $covoiturage
     * @return Response
     */
    public function show(Covoiturage $covoiturage) : Response
    {
        return $this->render('covoiturage/show.html.twig', [
            'covoiturage' => $covoiturage,
        ]);
    }

    /**
     * Créer un nouveau covoiturage.
     * @Route("/nouveau-covoiturage", name="covoiturage.create")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function create(Request $request, EntityManagerInterface $em) : Response
    {
        $covoiturage = new Covoiturage();
        $form = $this->createForm(CovoiturageType::class, $covoiturage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($covoiturage);
            $em->flush();
            return $this->redirectToRoute('covoiturage.list');
        }
        return $this->render('covoiturage/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Éditer un covoiturage.
     * @Route("covoiturage/{slug}/edit", name="covoiturage.edit")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function edit(Request $request, Covoiturage $covoiturage, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CovoiturageType::class, $covoiturage);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('covoiturage.list');
        }
        return $this->render('covoiturage/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * Supprimer un covoiturage.
     * @Route("covoiturage/{slug}/delete", name="covoiturage.delete")
     * @param Request $request
     * @param Covoiturage $covoiturage
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function delete(Request $request, Covoiturage $covoiturage, EntityManagerInterface $em): Response
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('covoiturage.delete', ['slug' => $covoiturage->getSlug()]))
            ->getForm();
        $form->handleRequest($request);
        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->render('covoiturage/delete.html.twig', [
                'covoiturage' => $covoiturage,
                'form' => $form->createView(),
            ]);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($covoiturage);
        $em->flush();
        return $this->redirectToRoute('covoiturage.list');
    }

}
