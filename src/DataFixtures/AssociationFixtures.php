<?php

namespace App\DataFixtures;

use App\Entity\Association;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AssociationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $association = new Association();
        $association->setTrailContent($faker->text);
        $association->setTrailHome($faker->text);
        $association->setTriathlonContent($faker->text);
        $association->setTriathlonHome($faker->text);
        $association->setClubContent($faker->text);
        $association->setClubHome($faker->text);
        $manager->persist($association);
        $manager->flush();
    }
}