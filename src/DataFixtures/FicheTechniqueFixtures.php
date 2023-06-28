<?php

namespace App\DataFixtures;

use App\Entity\FicheTechnique;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FicheTechniqueFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $ficheTechnique = new FicheTechnique();
        $ficheTechnique->setScreenSize('6.1 pouces');
        $ficheTechnique->setProcesseur('A14 Bionic');
        $ficheTechnique->setBatterie('2815 mAh');
        $ficheTechnique->setPhoto('Double caméra arrière 12MP');
        $ficheTechnique->setPoids('164 grammes');
        $ficheTechnique->setModele($this->getReference('modele_IPhone_12'));

        $manager->persist($ficheTechnique);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [ModeleFixtures::class];
    }
}