<?php

namespace App\Controller;

use App\Entity\Course;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CourseController extends AbstractController
{
    /**
     * @Route("/course", name="course_list", methods={"GET"})
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
     * @Route("/course/{slug}", name="course_post_show", methods={"GET"})
     * @param Course $course
     * @return Response
     */
    public function show(Course $course): Response
    {
        return $this->render("pages/showCourse.html.twig", [
            "course" => $course
        ]);
    }
}
