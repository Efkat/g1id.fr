<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Exercice;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/dashboard", name="admin")
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

        yield MenuItem::section("Activités", 'fa fa-keyboard');

        yield MenuItem::section("Cours", 'fa fa-book');

        yield MenuItem::section("Projets", 'fa fa-project-diagram');

        yield MenuItem::section("Exercices", 'fa fa-pencil-ruler');
        yield MenuItem::linkToCrud("Exercice",'fa fa-pencil-ruler', Exercice::class);

        yield MenuItem::section("Général", 'fa fa-globe');
        yield MenuItem::linkToCrud("Catégories", 'fa fa-bookmark', Category::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
