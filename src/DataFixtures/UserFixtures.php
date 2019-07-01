<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $user = new User();

        $user->setEmail('member@gtb.com');
        $user->setAddress($faker->address);
        $user->setBirthdate($faker->dateTime);
        $user->setFirstname($faker->firstName);
        $user->setLastname($faker->lastName);
        $user->setTelephone($faker->phoneNumber);
        $user->setRoles(['ROLE_MEMBER']);
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'memberpassword'));
        $manager->persist($user);
        $user->setGender($this->getReference('gender_' . rand(0, 2)));


        $user = new User();

        $user->setEmail('memberoffice@gtb.com');
        $user->setAddress($faker->address);
        $user->setBirthdate($faker->dateTime);
        $user->setFirstname($faker->firstName);
        $user->setLastname($faker->lastName);
        $user->setTelephone($faker->phoneNumber);
        $user->setRoles(['ROLE_OFFICE']);
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'officepassword'));
        $manager->persist($user);
        $user->setGender($this->getReference('gender_' . rand(0, 2)));

        $user = new User();

        $user->setEmail('admin@gtb.com');
        $user->setAddress($faker->address);
        $user->setBirthdate($faker->dateTime);
        $user->setFirstname($faker->firstName);
        $user->setLastname($faker->lastName);
        $user->setTelephone($faker->phoneNumber);
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'adminpassword'));
        $manager->persist($user);
        $user->setGender($this->getReference('gender_' . rand(0, 2)));

        $manager->flush();
    }

    public function getDependencies()
    {
        return [GenderFixtures::class];
    }
}
