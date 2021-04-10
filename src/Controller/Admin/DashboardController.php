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
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('G1id Fr');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section("Main", 'fa fa-pen-alt');
        yield MenuItem::linkToCrud("Exercice",'fa fa-pencil-ruler', Exercice::class);
        yield MenuItem::linkToCrud("Activités", 'fa fa-puzzle-piece', Activity::class);
        yield MenuItem::linkToCrud("Activités-Chapitre", 'fa fa-puzzle-piece', ActivityChapter::class);
        yield MenuItem::linkToCrud("Projets", 'fa fa-tools', Project::class);
        yield MenuItem::linkToCrud("Projets-Chapitre", 'fa fa-tools', ProjectChapter::class);
        yield MenuItem::linkToCrud("Cours","fa fa-book",Course::class);
        yield MenuItem::linkToCrud("Cours-Chapitre","fa fa-book",CourseChapter::class);

        yield MenuItem::section("Others", 'fa fa-globe');
        yield MenuItem::linkToCrud("Catégories", 'fa fa-bookmark', Category::class);
    }
}
