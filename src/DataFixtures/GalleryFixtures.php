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

        for ($i = 0; $i < 6; $i++) {
            $picture = new Galery();
            $picture->setUrl($faker->imageUrl());
            $picture->setAlt($faker->sentence);
            $picture->setPrivate($faker->boolean);
            $manager->persist($picture);
        }
        $manager->flush();
    }
}