<?php

namespace App\Controller\Admin;

use App\Entity\ProjectChapter;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProjectChapterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProjectChapter::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextareaField::new('content'),
            AssociationField::new('Project'),
            IntegerField::new('Time', 'Temps estimé')
        ];
    }
}
