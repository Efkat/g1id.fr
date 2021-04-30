<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Course;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use function Sodium\add;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create("fr_FR");
        $categories = [];
        for($i=0;$i<5;$i++){
            $category = new Category();
            $category->setName($faker->word);
            array_push($categories, $category);
            $manager->persist($category);
        }
        $this->addReference("category", $categories[$faker->numberBetween(1,5)]);
        for($i = 0; $i<100;$i++){
            $course = new Course();
            $course
                ->setTitle($faker->words(3, true))
                ->setSummary($faker->sentences(4, true))
                ->setDifficulty($faker->numberBetween(1, 5))
                ->setCategory($this->getReference("category"));
            $manager->persist($course);
        }
        $manager->flush();


    }
}
