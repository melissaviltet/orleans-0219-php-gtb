<?php

namespace App\DataFixtures;

use App\Entity\Galery;
use App\Entity\Association;
use App\Entity\Event;
use App\Entity\Sponsor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 15; $i++) {
            $sponsor = new Sponsor();
            $sponsor->setName($faker->sentence(1));
            $sponsor->setLogoUrl('https://via.placeholder.com/150/0000FF/808080C?Text=' . $i);
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

        for ($i = 0; $i<6; $i++) {
            $picture = new Galery();
            $picture->setUrl($faker->imageUrl());
            $picture->setAlt($faker->sentence);
            $picture->setPrivate($faker->boolean);
            $manager->persist($picture);

        for ($i = 0; $i < 4; $i++) {
            $event = new Event();
            $event->setName($faker->sentence(3));
            $event->setUrl($faker->url);
            $event->setDate($faker->dateTime);
            $event->setPlace($faker->city);
            $event->setIsPrivate($faker->boolean);
            $event->setPicture($faker->imageUrl());
            $manager->persist($event);
        }


        $manager->flush();
    }
}
