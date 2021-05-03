<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use App\Entity\ActivityChapter;
use App\Entity\Category;
use App\Entity\Course;
use App\Entity\CourseChapter;
use App\Entity\Exercice;
use App\Entity\Project;
use App\Entity\ProjectChapter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Gedmo\Mapping\Driver\Chain;

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
        for($i = 0; $i<20;$i++){
            $course = new Course();
            $chapitres = [];
            $course
                ->setTitle($faker->words(3, true))
                ->setSummary($faker->sentences(4, true))
                ->setDifficulty($faker->numberBetween(1, 5))
                ->setCategory($this->getReference("category"));
            $manager->persist($course);

            for($j=0; $j<3;$j++){
                $chapitre = new CourseChapter();
                $chapitre
                    ->setTitle($faker->words(3, true))
                    ->setTime($faker->numberBetween(5, 30))
                    ->setContent($faker->sentences(12, true));
                array_push($chapitres, $chapitre);
                $manager->persist($chapitre);
            }
            foreach ($chapitres as $chapitre) {
                $chapitre->setCourse($course);
            }
        }

        //Création des fixtures exercices
        for($i = 0; $i<20;$i++){
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
        for($i = 0; $i<20;$i++){
            $activity = new Activity();
            $chapitres = [];
            $activity
                ->setTitle($faker->words(3, true))
                ->setSummary($faker->sentences(4, true))
                ->setDifficulty($faker->numberBetween(1, 5))
                ->setCategory($this->getReference("category"));
            $manager->persist($activity);

            //Création des chapitres par activité
            for($j=0; $j<3;$j++){
                $chapitre = new ActivityChapter();
                $chapitre
                    ->setTitle($faker->words(3, true))
                    ->setTime($faker->numberBetween(5, 30))
                    ->setContent($faker->sentences(12, true));
                array_push($chapitres, $chapitre);
                $manager->persist($chapitre);
            }
            foreach ($chapitres as $chapitre) {
                $chapitre->setActivity($activity);
            }
        }

        //Création des fixtures projets
        for($i = 0; $i<20;$i++){
            $project = new Project();
            $chapitres = [];
            $project
                ->setTitle($faker->words(3, true))
                ->setSummary($faker->sentences(4, true))
                ->setDifficulty($faker->numberBetween(1, 5))
                ->setCategory($this->getReference("category"));

            //Création des chapitres PAR projets
            for($j=0; $j<3;$j++){
                $chapitre = new ProjectChapter();
                $chapitre
                    ->setTitle($faker->words(3, true))
                    ->setTime($faker->numberBetween(5, 30))
                    ->setContent($faker->sentences(12, true));
                array_push($chapitres, $chapitre);
                $manager->persist($chapitre);
            }
            foreach ($chapitres as $chapitre) {
                $chapitre->setProject($project);
            }
            $manager->persist($project);
        }
        $manager->flush();


    }
}
