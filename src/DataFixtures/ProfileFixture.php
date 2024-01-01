<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class ProfileFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $profile = new \App\Entity\Profile();
        $profile->setRs('Equipement 1');
        $profile->setUrl('Equipement 1');

        $profile = new \App\Entity\Profile();
        $profile->setRs('Equipement 2');
        $profile->setUrl('Equipement 2');

        $profile1 = new \App\Entity\Profile();
        $profile1->setRs('Equipement 3');
        $profile1->setUrl('Equipement 3');

        $profile2 = new \App\Entity\Profile();
        $profile2->setRs('Equipement 4');
        $profile2->setUrl('Equipement 4');

        $profile3 = new \App\Entity\Profile();
        $profile3->setRs('Equipement 5');
        $profile3->setUrl('Equipement 5');

        $manager->persist($profile);
        $manager->persist($profile2);
        $manager->persist($profile1);
        $manager->persist($profile3);
        $manager->flush();
    }
}
