<?php

namespace App\Controller;

use App\Entity\Activity;
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
}
