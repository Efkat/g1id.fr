<?php

namespace App\Controller;

use App\Entity\Course;
use App\Entity\CourseChapter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CourseController extends AbstractController
{
    /**
     * @Route("/cours", name="course_list", methods={"GET"})
     */
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $courseRepository = $entityManager->getRepository(Course::class);

        return $this->render('pages/generalList.html.twig', [
            'contentName' => 'cours',
            'contents' => $courseRepository->findAll()
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
        return $this->redirectToRoute('course_chapter_show', ['courseSlug'=> $course->getSlug(), 'chapterSlug'=> $firstChapter->getSlug()]);
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
