<?php


namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class EventFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

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