<?php

namespace App\Controller;

use App\Entity\Covoiturage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        $covoiturages = $this->getDoctrine()->getRepository(Covoiturage::class)->findAll();
        return $this->render('covoiturage/list.html.twig', [
            'covoiturages' => $covoiturages,
        ]);
    }
}