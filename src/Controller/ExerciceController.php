<?php

namespace App\Controller;

use App\Entity\Exercice;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExerciceController extends AbstractController
{
    /**
     * @Route("/exercices", name="exercice_list")
     */
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $exerciceRepository = $entityManager->getRepository(Exercice::class);

        return $this->render('pages/exerciceList.html.twig', [
            'exercices' => $exerciceRepository->findAll()
        ]);
    }

    /**
     * @Route("/exercices/{slug}", name="exercice_post_show")
     * @param Exercice $exercice
     * @return Response
     */
    public function show(Exercice $exercice): Response
    {
        return $this->render("pages/showExercice.html.twig", [
            "exercice" => $exercice
        ]);
    }
}
