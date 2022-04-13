<?php

namespace App\DataFixtures;

use App\Entity\Argonaut;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class ArgonautFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('el_GR');
        for ($i = 1; $i <= 50; $i++) {
            $argonaut = new Argonaut();
            $argonaut->setName($faker->firstName('male'));
            $manager->persist($argonaut);
        }
        $manager->flush();
    }
}
