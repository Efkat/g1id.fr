<?php

namespace App\Controller\Admin;

use App\Entity\Course;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CourseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Course::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title','Titre'),
            TextField::new('summary','Résumé'),
            AssociationField::new('Category','Catégorie'),
            ChoiceField::new('Difficulty', 'Difficulté')->setChoices(["Facile" => 1, "Modéré" => 2, "Sportif" => 3, "Difficile" => 4, "Extrème" => 5]),
            BooleanField::new('IsVisible', 'Visible ?'),
            ArrayField::new('Prerequisites', 'Pré-requis')
        ];
    }

}
