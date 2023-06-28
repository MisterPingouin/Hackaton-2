<?php

namespace App\DataFixtures;

use App\Entity\Modele;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ModeleFixtures extends Fixture implements DependentFixtureInterface
{
    public const APPLE = [
        'IPhone 11',
        'IPhone 12',
        'IPhone 13',
    ];

    public const SAMSUNG = [
        'Galaxy Note20',
        'Galaxy Z Flip3',
        'Galaxy A52s',
    ];

    public const LG = [
        'Q52',
        'K62',
        'XPRESSION PLUS 3',
    ];

    public const WIKO = [
        'Ozzy',
        'Sunny 5',
        'Harry',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::APPLE as $one) {
            $modele = new Modele();
            $modele->setName($one);
            $modele->setMarque($this->getReference('marque_Apple'));
            $manager->persist($modele);
            $this->addReference('modele_' . str_replace(' ', '_', $one), $modele);

        }
        foreach (self::SAMSUNG as $one) {
            $modele = new Modele();
            $modele->setName($one);
            $modele->setMarque($this->getReference('marque_Samsung'));
            $manager->persist($modele);
            $this->addReference('modele_' . str_replace(' ', '_', $one), $modele);
        }
        foreach (self::LG as $one) {
            $modele = new Modele();
            $modele->setName($one);
            $modele->setMarque($this->getReference('marque_Lg'));
            $manager->persist($modele);
            $this->addReference('modele_' . str_replace(' ', '_', $one), $modele);
        }
        foreach (self::WIKO as $one) {
            $modele = new Modele();
            $modele->setName($one);
            $modele->setMarque($this->getReference('marque_Wiko'));
            $manager->persist($modele);
            $this->addReference('modele_' . str_replace(' ', '_', $one), $modele);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [MarqueFixtures::class];
    }

    
}
