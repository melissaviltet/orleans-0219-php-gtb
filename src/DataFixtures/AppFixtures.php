<?php

namespace App\DataFixtures;

use App\Entity\Association;
use App\Entity\Sponsor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 9; $i++) {
            $sponsor = new Sponsor();
            $sponsor->setName($faker->sentence(1));
            $sponsor->setLogoUrl($faker->imageUrl(800, 600, 'abstract', true, 'Faker', true));
            $sponsor->setSite($faker->url);
            $manager->persist($sponsor);
        }
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
