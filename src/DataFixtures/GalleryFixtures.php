<?php


namespace App\DataFixtures;

use App\Entity\Galery;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class GalleryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 12; $i++) {
            $picture = new Galery();
            $picture->setAlt($faker->sentence);
            $picture->setImageName('logo_veloland.jpg');
            $picture->setImageSize(1024);
            $picture->setPrivate($faker->boolean);
            $manager->persist($picture);
        }
        $manager->flush();
    }
}
