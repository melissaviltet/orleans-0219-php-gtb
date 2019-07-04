<?php

namespace App\DataFixtures;

use App\Entity\Sponsor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 12; $i++) {
            $sponsor = new Sponsor();
            $sponsor->setName($faker->sentence(2));
            $sponsor->setImageName('logo_veloland.jpg');
            $sponsor->setImageSize(1024);
            $sponsor->setSite($faker->url);
            $manager->persist($sponsor);
        }
        $manager->flush();
    }
}
