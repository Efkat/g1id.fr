<?php

namespace App\Controller;

use App\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    /**
     * @Route("/projets", name="project_list")
     */
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $projectRepository = $entityManager->getRepository(Project::class);

        return $this->render('pages/generalList.html.twig', [
            'contentName' => 'projets',
            'contents' => $projectRepository->findAll()
        ]);
    }

    /**
     * @Route("/projets/{slug}", name="project_post_show", methods={"GET"})
     * @param Project $project
     * @return Response
     */
    public function show(Project $project):Response
    {
        $chapters = $project->getProjectChapters();
        $timer = 0;
        foreach ($chapters as $chapter){
            echo $chapter->getTime();
            $timer += (int)$chapter->getTime();
        }
        return $this->render("pages/showProject.html.twig",[
            "project" => $project,
            "chapters" => $chapters,
            "time" => $timer
        ]);
    }
}
