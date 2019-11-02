<?php

namespace App\DataFixtures;

use App\Entity\Car;
use App\Entity\Dealer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        for ($d = 1; $d <= 5; $d++) {
            $dealer = new Dealer();
            $dealer->setName("Concessionnaire n° $d");
            $manager->persist($dealer);

            for ($c = 1; $c <= 100; $c++) {
                $car = new Car();
                $car->setModel($faker->randomElement(array('Mercedes', 'Peugeot', 'Renault')))
                    ->setColor($faker->randomElement(array('Blanche', 'Noire', 'Bleue')))
                    ->setEngine($faker->randomElement(array('Essence', 'Diesel', 'GPL')))
                    ->setSeats(mt_rand(4, 8))
                    ->setDealer($dealer);
                $manager->persist($car);
            }
        }

        $manager->flush();
    }
}
