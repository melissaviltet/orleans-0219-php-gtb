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
        $users = [
            [
                'mail' => 'member@gtb.com',
                'password' => 'memberpassword',
                'role' => ['ROLE_PRESIDENT'],
                'status' => 'President'
            ],
            [
                'mail' => 'member@gtb.com',
                'password' => 'memberpassword',
                'role' => ['ROLE_OFFICE'],
                'status' => 'Secrétaire'],
            [
                'mail' => 'member@gtb.com',
                'password' => 'memberpassword',
                'role' => ['ROLE_PRESIDENT'],
                'status' => 'President Trail'
            ],
            [
                'mail' => 'member@gtb.com',
                'password' => 'memberpassword',
                'role' => ['ROLE_PRESIDENT'],
                'status' => 'President Triathlon'
            ],
            [
                'mail' => 'member@gtb.com',
                'password' => 'memberpassword',
                'role' => ['ROLE_OFFICE'],
                'status' => 'Secrétaire adjoint(e)'
            ],
            [
                'mail' => 'member@gtb.com',
                'password' => 'memberpassword',
                'role' => ['ROLE_OFFICE'],
                'status' => 'Trésorier(e)'
            ],
            [
                'mail' => 'member@gtb.com',
                'password' => 'memberpassword',
                'role' => ['ROLE_OFFICE'],
                'status' => 'Trésorier(e) adjoint(e)'
            ],
            [
                'mail' => 'member@gtb.com',
                'password' => 'memberpassword',
                'role' => ['ROLE_SPORTS'],
                'status' => 'Encadrant sportif'
            ],
            [
                'mail' => 'memberhonneur@gtb.com',
                'password' => 'memberhonneurpassword',
                'role' => ['ROLE_OFFICE'],
                'status' => 'Membre d\'honneur'
            ],
        ];

        for ($i = 0; $i < 100; $i++) {
            $users[] = ['mail' => $faker->email, 'password' => 'pass', 'role' => ['ROLE_MEMBER'], 'status' => 'Membre'];
        }

        foreach ($users as $key => $member) {
            $user = new User();

            $user->setEmail($faker->email);
            $user->setAddress($faker->address);
            $user->setBirthdate($faker->dateTime);
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setTelephone($faker->phoneNumber);
            $user->setRoles($member['role']);
            $user->setStatus($member['status']);
            $user->setImageName('logo_veloland.jpg');
            $user->setPassword($this->passwordEncoder->encodePassword($user, 'memberpassword'));
            $this->addReference('user_' . $key, $user);
            $manager->persist($user);
            $user->setGender($this->getReference('gender_' . rand(0, 2)));
        }

        $user = new User();

        $user->setEmail('admin@gtb.com');
        $user->setAddress($faker->address);
        $user->setBirthdate($faker->dateTime);
        $user->setFirstname($faker->firstName);
        $user->setLastname($faker->lastName);
        $user->setTelephone($faker->phoneNumber);
        $user->setRoles(['ROLE_ADMIN']);
        $user->setImageName('logo_veloland.jpg');
        $user->setStatus('Administrateur');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'adminpassword'));
        $manager->persist($user);
        $this->addReference('user_420', $user);
        $user->setGender($this->getReference('gender_' . rand(0, 2)));

        $manager->flush();
    }

    public function getDependencies()
    {
        return [GenderFixtures::class];
    }
}
