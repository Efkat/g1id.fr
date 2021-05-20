<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Entity\Course;
use App\Entity\Exercice;
use App\Entity\Progression;
use App\Entity\Project;
use App\Entity\User;
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

    /**
     * @Route ("/markAsRead/{type}/{slug}", name="markAsRead")
     * @param string $type
     * @param string $slug
     * @return Response
     */
    public function markAsRead(string $type, string $slug): Response
    {
        $user = $this->getUser();
        if($user){
            $entityManager = $this->getDoctrine()->getManager();

            $progression = new Progression();
            $progression->setType($type)
                ->setSlug($slug)
                ->setUser($user);

            $userProgs = $user->getProgressions();
            $userProgsArray = [];
            foreach ($userProgs as $prog){
                array_push($userProgsArray, $prog);
            }

            if(in_array($progression, $userProgsArray)){
                return $this->redirectToRoute("home");
            }

            $entityManager->persist($progression);
            $entityManager->flush();
        }
        return $this->redirectToRoute("home");
    }

    public function homeLogged(): Response
    {
        return new Response("<html> HELLO USER </html>");
    }
}
