<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Entity\Course;
use App\Entity\Exercice;
use App\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $courseRepository = $entityManager->getRepository(Course::class);
        $projectRepository = $entityManager->getRepository(Project::class);
        $activityRepository = $entityManager->getRepository(Activity::class);
        $exerciceRepository = $entityManager->getRepository(Exercice::class);

        return $this->render('pages/home.html.twig',[
            'courses' => $courseRepository->findLast(),
            'projects' => $projectRepository->findLast(),
            'activities' => $activityRepository->findLast(),
            'exercises' => $exerciceRepository->findLast()
        ]);
    }

    public function homeLogged(): Response
    {
        return new Response("<html> HELLO USER </html>");
    }
}
