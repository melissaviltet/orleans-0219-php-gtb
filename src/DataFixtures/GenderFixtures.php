<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Gender;

class GenderFixtures extends Fixture
{
    const GENDERS = [
        'Homme',
        'Femme',
        'Autres'
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::GENDERS as $key => $genderName) {
            $gender = new Gender();
            $gender->setGenderName($genderName);
            $manager->persist($gender);
            $this->addReference('gender_' . $key, $gender);
        }
        $manager->flush();
    }
}
