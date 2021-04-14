<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Entity\ActivityChapter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActivityController extends AbstractController
{
    /**
     * @Route("/activites", name="activity_list")
     */
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $activityRepository = $entityManager->getRepository(Activity::class);

        return $this->render('pages/generalList.html.twig', [
            'contentName' => 'activités',
            'contents' => $activityRepository->findAll()
        ]);
    }

    /**
     * @Route("/activites/{slug}", name="activity_post_show", methods={"GET"})
     * @param Activity $activity
     * @return Response
     */
    public function show(Activity $activity): Response
    {
        $chapters = $activity->getActivityChapters();

        return $this->render("pages/showActivity.html.twig",[
            "activity" => $activity,
            "chapters" => $chapters
        ]);
    }
}
