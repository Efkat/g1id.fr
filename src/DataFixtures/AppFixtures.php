<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use App\Entity\Category;
use App\Entity\Course;
use App\Entity\Exercice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create("fr_FR");

        //Création des fixtures catégories
        $categories = [];
        for($i=0;$i<5;$i++){
            $category = new Category();
            $category->setName($faker->word);
            array_push($categories, $category);
            $manager->persist($category);
        }
        //Création de la référence sur une catégorie
        $this->addReference("category", $categories[$faker->numberBetween(1,5)]);

        //Création des fixtures Cours
        for($i = 0; $i<100;$i++){
            $course = new Course();
            $course
                ->setTitle($faker->words(3, true))
                ->setSummary($faker->sentences(4, true))
                ->setDifficulty($faker->numberBetween(1, 5))
                ->setCategory($this->getReference("category"));
            $manager->persist($course);
        }

        //Création des fixtures exercices
        for($i = 0; $i<100;$i++){
            $exercice = new Exercice();
            $exercice
                ->setTitle($faker->words(3, true))
                ->setContent($faker->sentences(4, true))
                ->setHelp($faker->sentences(4, true))
                ->setCorrection($faker->sentences(4, true))
                ->setDifficulty($faker->numberBetween(1, 5))
                ->setCategory($this->getReference("category"));
            $manager->persist($exercice);
        }

        //Création des fixtures Activités
        for($i = 0; $i<100;$i++){
            $activity = new Activity();
            $activity
                ->setTitle($faker->words(3, true))
                ->setSummary($faker->sentences(4, true))
                ->setDifficulty($faker->numberBetween(1, 5))
                ->setCategory($this->getReference("category"));
            $manager->persist($activity);
        }
        $manager->flush();


    }
}
