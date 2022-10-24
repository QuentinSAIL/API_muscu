<?php

namespace App\DataFixtures;

use App\Entity\Exercice;
use App\Entity\Muscle;
use App\Entity\Region;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;
use Faker\Factory;

class AppFixtures extends Fixture
{

    /**
     * @var Generator
     */
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create("fr_FR");
    }

    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i < 20; $i++) {
            $exercice = new Exercice();
            $exercice->setExerciceName($this->faker->word())
            ->setExerciceDescription($this->faker->text(30))
            ->setStatus('on')
            ->setExercicePicture('rien')
            ->setExerciceURL('rien');
            $manager->persist($exercice);

            $region = new Region();
            $region->setRegionName($this->faker->word())
                ->setRegionPicture("ok");
            $manager->persist($region);

            $muscle = new Muscle();
            $muscle->setMuscleName($this->faker->word())
                ->setRegionID($region);
            $manager->persist($muscle);
        }
        $manager->flush();
    }
}