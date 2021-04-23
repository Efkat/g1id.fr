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
        $firstChapter = $chapters[0];
        if(!$firstChapter == null){
            return $this->redirectToRoute('activity_chapter_show', ['activitySlug'=> $activity->getSlug(), 'chapterSlug'=> $firstChapter->getSlug()]);
        }else{
            return $this->redirectToRoute('home');
        }

    }

    /**
     * @Route("/activites/{activitySlug}/{chapterSlug}", name="activity_chapter_show", methods={"GET"})
     * @param String $activitySlug
     * @param String $chapterSlug
     * @return Response
     */
    public function showActivityChapter(String $activitySlug, String $chapterSlug):Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $activityRepository = $entityManager->getRepository(Activity::class);
        $chapterRepository = $entityManager->getRepository(ActivityChapter::class);

        $activity = $activityRepository->findOneBy(array('slug'=> $activitySlug));
        $chapter = $chapterRepository->findOneBy(array('slug' => $chapterSlug));
        $chapters = $activity->getActivityChapters();

        $timer = 0;
        foreach ($chapters as $chapterUnit){
            $timer += (int)$chapterUnit->getTime();
        }

        return $this->render("pages/showActivity.html.twig", [
            "activity" => $activity,
            "chapters" => $chapters,
            "currentChapter" => $chapter,
            "time" => $timer
        ]);
    }
}
