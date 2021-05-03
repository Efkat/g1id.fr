<?php

namespace App\Controller\Admin;

use App\Entity\Activity;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ActivityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Activity::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Titre'),
            TextField::new('summary', 'Résumé'),
            AssociationField::new('Category', 'Catégorie'),
            ChoiceField::new('Difficulty', 'Difficulté')->setChoices(["Facile" => 1, "Modéré" => 2, "Sportif" => 3, "Difficile" => 4, "Extrème" => 5])
        ];
    }
}
