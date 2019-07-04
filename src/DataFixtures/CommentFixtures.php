<?php


namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [EventFixtures::class, UserFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 100; $i++) {
            $comment = new Comment();
            $comment->setDate($faker->dateTime());
            $comment->setIsActive($faker->boolean());
            $comment->setMessage($faker->sentence(10));
            $comment->setEvent($this->getReference('event_' . rand(0, 19)));
            $comment->setUser($this->getReference('user_' . rand(0, 2)));
            $manager->persist($comment);
        }
        $manager->flush();
    }
}
