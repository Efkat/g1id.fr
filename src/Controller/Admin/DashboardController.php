<?php

namespace App\Controller\Admin;

use App\Entity\Activity;
use App\Entity\ActivityChapter;
use App\Entity\Category;
use App\Entity\Course;
use App\Entity\CourseChapter;
use App\Entity\Exercice;
use App\Entity\Project;
use App\Entity\ProjectChapter;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/dashboard", name="admin")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $userRepo = $em->getRepository(User::class);

        return $this->render("admin/dashboard.html.twig",[
            "user" => $this->getUser(),
            "userCount" => $userRepo->getTotalUsers()
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('G1id Fr');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section("Main", 'fas fa-globe');
        yield MenuItem::subMenu('Activités', 'fa fa-pen-alt')->setSubItems([
            MenuItem::linkToCrud('Activités', 'fa fa-pen-alt', Activity::class),
            MenuItem::linkToCrud('Chapitres', 'fa fa-file-text', ActivityChapter::class)
        ]);
        yield MenuItem::subMenu('Projets', 'fa fa-tools')->setSubItems([
            MenuItem::linkToCrud('Projets', 'fa fa-tools', Project::class),
            MenuItem::linkToCrud('Chapitres', 'fa fa-file-text', ProjectChapter::class)
        ]);
        yield MenuItem::subMenu('Cours', 'fa fa-book')->setSubItems([
            MenuItem::linkToCrud('Cours', 'fa fa-book', Course::class),
            MenuItem::linkToCrud('Chapitres', 'fa fa-file-text', CourseChapter::class)
        ]);
        yield MenuItem::linkToCrud("Exercice",'fa fa-pencil-ruler', Exercice::class);


        yield MenuItem::section("Others", 'fa fa-globe');
        yield MenuItem::linkToCrud("Catégories", 'fa fa-bookmark', Category::class);
        yield MenuItem::linkToCrud("Utilisateurs", 'fa fa-users', User::class);
    }
}
