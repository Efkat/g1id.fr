<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Entity\ActivityChapter;
use App\Entity\Progression;
use App\ParsedownExtensionMathJaxLaTex;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActivityController extends AbstractController
{
    /**
     * @Route("/a", name="hidden_activities")
     * @IsGranted("ROLE_ADMIN")
     */
    public function showHidden(Request $request,PaginatorInterface $paginator){
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Activity::class);

        $activities = $paginator->paginate(
            $repo->findAllHidden(),
            $request->query->getInt('page',1),
            9
        );

        return $this->render('pages/generalList.html.twig', [
            'contentName' => 'activités',
            'contents' => $activities
        ]);
    }

    /**
     * @Route("/activites", name="activity_list")
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $activityRepository = $entityManager->getRepository(Activity::class);

        $activities = $paginator->paginate(
            $activityRepository->findAll(),
            $request->query->getInt('page',1),
            9
        );
        return $this->render('pages/generalList.html.twig', [
            'contentName' => 'activités',
            'contents' => $activities
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
        $parser = new ParsedownExtensionMathJaxLaTex();
        $user = $this->getUser();

        $userProgs = $user->getProgressions();
        $userSlugArray = [];
        foreach ($userProgs as $prog){
            array_push($userSlugArray, $prog->getSlug());
        }

        $entityManager = $this->getDoctrine()->getManager();
        $activityRepository = $entityManager->getRepository(Activity::class);
        $chapterRepository = $entityManager->getRepository(ActivityChapter::class);

        $activity = $activityRepository->findOneBy(array('slug'=> $activitySlug));
        $chapter = $chapterRepository->findOneBy(array('slug' => $chapterSlug));
        $chapters = $activity->getActivityChapters();

        $chapter->setContent($parser->parse($chapter->getContent()));

        $timer = 0;
        foreach ($chapters as $chapterUnit){
            $timer += (int)$chapterUnit->getTime();
        }

        return $this->render("pages/showActivity.html.twig", [
            "activity" => $activity,
            "chapters" => $chapters,
            "currentChapter" => $chapter,
            "time" => $timer,
            "slugs" => $userSlugArray
        ]);
    }
}
