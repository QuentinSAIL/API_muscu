<?php

namespace App\DataFixtures;

use App\Entity\Exercice;
use App\Entity\Muscle;
use App\Entity\Region;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    /**
     * @var Generator
     */
    private Generator $faker;

    /*
     * classe qui hash les mdp
     * @var UserPasswordHasherInterface
     */
    private $userPasswordHasher;


    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->faker = Factory::create("fr_FR");
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $userNumber = 10;

        //authent
        $adminUSer = new User();
        $password = "password";
        $adminUSer->setEmail("admin@email")
            ->setPassword($this->userPasswordHasher->hashPassword($adminUSer, $password))
            ->setRoles(["ROLE_ADMIN"]);
        $manager->persist($adminUSer);

        //user

        for ($i=0; $i < $userNumber; $i++) {
            $userUser = new User();
            $password = $this->faker->password(2,6);

            $userUser->setEmail($this->faker->email() . '@' . $password)
                ->setRoles(["ROLE_USER"])
                ->setPassword($this->userPasswordHasher->hashPassword($userUser, $password));
            $manager->persist($userUser);

        }
        $manager->flush();
    }
}