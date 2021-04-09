<?php

namespace App\Controller\Admin;

use App\Entity\ActivityChapter;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
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
            TextField::new('Title'),
            TextField::new('Content'),
            AssociationField::new('Activity')
        ];
    }
}