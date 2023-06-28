<?php

namespace App\DataFixtures;

use App\Entity\Marque;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MarqueFixtures extends Fixture
{
    public const MARQUE = [
        'Apple',
        'Samsung',
        'Lg',
        'Wiko'
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::MARQUE as $oneMarque) {
            $marque = new Marque();
            $marque->setName($oneMarque);
            $manager->persist($marque);
            $this->addReference('marque_' . $oneMarque, $marque);
        }
        $manager->flush();
    }
}
