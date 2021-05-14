<?php

namespace App\Controller;

use App\Entity\Exercice;
use App\ParsedownExtensionMathJaxLaTex;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExerciceController extends AbstractController
{
    /**
     * @Route("/exercices", name="exercice_list")
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $exerciceRepository = $entityManager->getRepository(Exercice::class);

        $exercises = $paginator->paginate(
            $exerciceRepository->findAll(),
            $request->query->getInt('page',1),
            9
        );

        return $this->render('pages/exerciceList.html.twig', [
            'exercices' => $exercises
        ]);
    }

    /**
     * @Route("/exercices/{slug}", name="exercice_post_show")
     * @param Exercice $exercice
     * @return Response
     */
    public function show(Exercice $exercice): Response
    {
        $parser = new ParsedownExtensionMathJaxLaTex();

        return $this->render("pages/showExercice.html.twig", [
            "title" => $exercice->getTitle(),
            "content" => $parser->parse($exercice->getContent()),
            "help" => $parser->parse($exercice->getHelp()),
            "correction" => $parser->parse($exercice->getCorrection())
        ]);
    }
}
