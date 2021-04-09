<?php

namespace App\Controller;

use App\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    /**
     * @Route("/project", name="project_list")
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
}
