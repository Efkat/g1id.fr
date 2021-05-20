<?php

namespace App\Controller;

use App\Entity\Progression;
use App\Entity\Project;
use App\Entity\ProjectChapter;
use App\ParsedownExtensionMathJaxLaTex;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    /**
     * @Route("/projets", name="project_list")
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $projectRepository = $entityManager->getRepository(Project::class);

        $projects = $paginator->paginate(
            $projectRepository->findAll(),
            $request->query->getInt('page',1),
            9
        );

        return $this->render('pages/generalList.html.twig', [
            'contentName' => 'projets',
            'contents' => $projects
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
        $firstChapter = $chapters[0];
        if(!$firstChapter == null){
            return $this->redirectToRoute('project_chapter_show', ['projectSlug'=> $project->getSlug(), 'chapterSlug'=> $firstChapter->getSlug()]);
        }else{
            return $this->redirectToRoute('home');
        }
    }

    /**
     * @Route("/projets/{projectSlug}/{chapterSlug}", name="project_chapter_show", methods={"GET"})
     * @param String $projectSlug
     * @param String $chapterSlug
     * @return Response
     */
    public function showProjectChapter(String $projectSlug, String $chapterSlug):Response
    {
        $parser = new ParsedownExtensionMathJaxLaTex();
        $user = $this->getUser();

        $chapterRead = false;

        $userProgs = $user->getProgressions();
        $userSlugArray = [];
        foreach ($userProgs as $prog){
            array_push($userSlugArray, $prog->getSlug());
        }

        $tempProg = new Progression();
        $tempProg->setUser($user)
            ->setType('project')
            ->setSlug($chapterSlug);

        if (in_array($chapterSlug, $userSlugArray)){
            $chapterRead = true;
        }

        $entityManager = $this->getDoctrine()->getManager();
        $projectRepository = $entityManager->getRepository(Project::class);
        $chapterRepository = $entityManager->getRepository(ProjectChapter::class);

        $project = $projectRepository->findOneBy(array('slug'=> $projectSlug));
        $chapter = $chapterRepository->findOneBy(array('slug' => $chapterSlug));
        $chapters = $project->getProjectChapters();

        $chapter->setContent($parser->parse($chapter->getContent()));

        $timer = 0;
        foreach ($chapters as $chapterUnit){
            $timer += (int)$chapterUnit->getTime();
        }

        return $this->render("pages/showProject.html.twig", [
            "project" => $project,
            "chapters" => $chapters,
            "currentChapter" => $chapter,
            "time" => $timer,
            "isRead" => $chapterRead
        ]);
    }
}
