<?php

namespace App\Controller;

use App\Entity\Exercice;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExerciceController extends AbstractController
{
    /**
     * @Route("/exercice", name="exercice_list")
     */
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $exerciceRepository = $entityManager->getRepository(Exercice::class);

        return $this->render('pages/exerciceList.html.twig', [
            'exercices' => $exerciceRepository->findAll()
        ]);
    }
}
