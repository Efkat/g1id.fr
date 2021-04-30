<?php

namespace App\Controller;

use App\Entity\Course;
use App\Entity\CourseChapter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface; // Nous appelons le bundle KNP Paginator


class CourseController extends AbstractController
{
    /**
     * @Route("/cours", name="course_list", methods={"GET"})
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $courseRepository = $entityManager->getRepository(Course::class);
        $cours = $paginator->paginate(
            $courseRepository->findAll(),
            $request->query->getInt('page',1),
            12
        );
        return $this->render('pages/generalList.html.twig', [
            'contentName' => 'cours',
            'contents' => $cours
        ]);
    }

    /**
     * @Route("/cours/{slug}", name="course_post_show")
     * @param Course $course
     * @return Response
     */
    public function show(Course $course): Response
    {
        $chapters = $course->getCourseChapters();
        $firstChapter = $chapters[0];
        if(!$firstChapter == null){
            return $this->redirectToRoute('course_chapter_show', ['courseSlug'=> $course->getSlug(), 'chapterSlug'=> $firstChapter->getSlug()]);
        }else{
            return $this->redirectToRoute('home');
        }

    }

    /**
     * @Route("/cours/{courseSlug}/{chapterSlug}", name="course_chapter_show", methods={"GET"})
     * @param String $courseSlug
     * @param String $chapterSlug
     * @return Response
     */
    public function showCourseChapter(String $courseSlug, String $chapterSlug): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $courseRepository = $entityManager->getRepository(Course::class);
        $chapterRepository = $entityManager->getRepository(CourseChapter::class);

        $course = $courseRepository->findOneBy(array('slug'=> $courseSlug));
        $chapter = $chapterRepository->findOneBy(array('slug' => $chapterSlug));
        $chapters = $course->getCourseChapters();

        $timer = 0;
        foreach ($chapters as $chapterUnit){
            $timer += (int)$chapterUnit->getTime();
        }

        return $this->render("pages/showCourse.html.twig", [
            "course" => $course,
            "chapters" => $chapters,
            "currentChapter" => $chapter,
            "time" => $timer
        ]);
    }
}
