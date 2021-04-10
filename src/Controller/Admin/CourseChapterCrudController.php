<?php

namespace App\Controller\Admin;

use App\Entity\CourseChapter;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CourseChapterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CourseChapter::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title','Titre'),
            TextField::new('content','Contenu'),
            AssociationField::new('Course','Cours')
        ];
    }

}
