<?php

namespace App\Controller\Admin;

use App\Entity\Exercice;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ExerciceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Exercice::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Titre'),
            TextField::new('Content', 'Enoncé'),
            TextField::new('Help', 'Aide'),
            TextField::new('Correction', 'Correction'),
            AssociationField::new('Category', 'Catégories'),
            ChoiceField::new('Difficulty', 'Difficulté')->setChoices(["Facile" => 1, "Modéré" => 2, "Sportif" => 3, "Difficile" => 4, "Extrème" => 5])
        ];
    }
}
