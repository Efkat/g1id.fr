<?php

namespace App\Controller\Admin;

use App\Entity\ActivityChapter;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class ActivityChapterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ActivityChapter::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Title', 'Titre'),
            TextareaField::new('Content', 'Contenu'),
            AssociationField::new('Activity', 'Activité'),
            IntegerField::new('Time', 'Temps estimé')
        ];
    }
}