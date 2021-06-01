<?php

namespace App\Controller\Admin;

use App\Entity\Progression;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            EmailField::new('email', 'Adresse mail'),
            TextField::new('name', 'Nom d\'utilisateur'),
            DateField::new('birth', 'Date d\'anniversaire'),
            ArrayField::new('roles', 'Roles'),
            ArrayField::new('progressions', 'Progression')
        ];
    }
}
