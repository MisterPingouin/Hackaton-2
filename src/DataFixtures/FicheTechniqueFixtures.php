<?php

namespace App\DataFixtures;

use App\Entity\FicheTechnique;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FicheTechniqueFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Iphone 11
        $ficheTechnique1 = new FicheTechnique();
        $ficheTechnique1->setScreenSize('6.1 pouces');
        $ficheTechnique1->setProcesseur('A13 Bionic');
        $ficheTechnique1->setBatterie('3110 mAh');
        $ficheTechnique1->setPhoto('Double caméra arrière 12MP');
        $ficheTechnique1->setPoids('194 grammes');
        $ficheTechnique1->setModele($this->getReference('modele_IPhone_11'));
        $manager->persist($ficheTechnique1);

        // Iphone 12
        $ficheTechnique2 = new FicheTechnique();
        $ficheTechnique2->setScreenSize('6.1 pouces');
        $ficheTechnique2->setProcesseur('A14 Bionic');
        $ficheTechnique2->setBatterie('2815 mAh');
        $ficheTechnique2->setPhoto('Double caméra arrière 12MP');
        $ficheTechnique2->setPoids('164 grammes');
        $ficheTechnique2->setModele($this->getReference('modele_IPhone_12'));
        $manager->persist($ficheTechnique2);

        // Galaxy Note20
        $ficheTechnique3 = new FicheTechnique();
        $ficheTechnique3->setScreenSize('6.7 pouces');
        $ficheTechnique3->setProcesseur('Exynos 990');
        $ficheTechnique3->setBatterie('4300 mAh');
        $ficheTechnique3->setPhoto('Triple caméra arrière 12MP');
        $ficheTechnique3->setPoids('192 grammes');
        $ficheTechnique3->setModele($this->getReference('modele_Galaxy_Note20'));
        $manager->persist($ficheTechnique3);

        // Galaxy Z Flip3
        $ficheTechnique4 = new FicheTechnique();
        $ficheTechnique4->setScreenSize('6.7 pouces (plié)');
        $ficheTechnique4->setProcesseur('Qualcomm Snapdragon 888');
        $ficheTechnique4->setBatterie('3300 mAh');
        $ficheTechnique4->setPhoto('Double caméra arrière 12MP');
        $ficheTechnique4->setPoids('183 grammes');
        $ficheTechnique4->setModele($this->getReference('modele_Galaxy_Z_Flip3'));
        $manager->persist($ficheTechnique4);

        // Galaxy A52s
        $ficheTechnique5 = new FicheTechnique();
        $ficheTechnique5->setScreenSize('6.5 pouces');
        $ficheTechnique5->setProcesseur('Qualcomm Snapdragon 778G');
        $ficheTechnique5->setBatterie('4500 mAh');
        $ficheTechnique5->setPhoto('Quadruple caméra arrière 64MP');
        $ficheTechnique5->setPoids('189 grammes');
        $ficheTechnique5->setModele($this->getReference('modele_Galaxy_A52s'));
        $manager->persist($ficheTechnique5);

        // Q52
        $ficheTechnique6 = new FicheTechnique();
        $ficheTechnique6->setScreenSize('6.6 pouces');
        $ficheTechnique6->setProcesseur('Mediatek MT6765 Helio P35');
        $ficheTechnique6->setBatterie('4000 mAh');
        $ficheTechnique6->setPhoto('Triple caméra arrière 13MP');
        $ficheTechnique6->setPoids('186 grammes');
        $ficheTechnique6->setModele($this->getReference('modele_Q52'));
        $manager->persist($ficheTechnique6);

        // K62
        $ficheTechnique7 = new FicheTechnique();
        $ficheTechnique7->setScreenSize('6.6 pouces');
        $ficheTechnique7->setProcesseur('Mediatek MT6765 Helio P35');
        $ficheTechnique7->setBatterie('4000 mAh');
        $ficheTechnique7->setPhoto('Quadruple caméra arrière 48MP');
        $ficheTechnique7->setPoids('186 grammes');
        $ficheTechnique7->setModele($this->getReference('modele_K62'));
        $manager->persist($ficheTechnique7);

        // XPRESSION PLUS 3
        $ficheTechnique8 = new FicheTechnique();
        $ficheTechnique8->setScreenSize('2.8 pouces');
        $ficheTechnique8->setProcesseur('Mediatek MT6761D');
        $ficheTechnique8->setBatterie('1900 mAh');
        $ficheTechnique8->setPhoto('Double caméra arrière 8MP');
        $ficheTechnique8->setPoids('119 grammes');
        $ficheTechnique8->setModele($this->getReference('modele_XPRESSION_PLUS_3'));
        $manager->persist($ficheTechnique8);

        // Ozzy
        $ficheTechnique9 = new FicheTechnique();
        $ficheTechnique9->setScreenSize('5.5 pouces');
        $ficheTechnique9->setProcesseur('Mediatek MT6580');
        $ficheTechnique9->setBatterie('2000 mAh');
        $ficheTechnique9->setPhoto('Double caméra arrière 5MP');
        $ficheTechnique9->setPoids('145 grammes');
        $ficheTechnique9->setModele($this->getReference('modele_Ozzy'));
        $manager->persist($ficheTechnique9);

        // Sunny 5
        $ficheTechnique10 = new FicheTechnique();
        $ficheTechnique10->setScreenSize('5 pouces');
        $ficheTechnique10->setProcesseur('Mediatek MT6580');
        $ficheTechnique10->setBatterie('2000 mAh');
        $ficheTechnique10->setPhoto('Double caméra arrière 5MP');
        $ficheTechnique10->setPoids('134 grammes');
        $ficheTechnique10->setModele($this->getReference('modele_Sunny_5'));
        $manager->persist($ficheTechnique10);

        // Harry
        $ficheTechnique11 = new FicheTechnique();
        $ficheTechnique11->setScreenSize('5 pouces');
        $ficheTechnique11->setProcesseur('Mediatek MT6735');
        $ficheTechnique11->setBatterie('2000 mAh');
        $ficheTechnique11->setPhoto('Double caméra arrière 13MP');
        $ficheTechnique11->setPoids('150 grammes');
        $ficheTechnique11->setModele($this->getReference('modele_Harry'));
        $manager->persist($ficheTechnique11);

        // Iphone 13
        $ficheTechnique12 = new FicheTechnique();
        $ficheTechnique12->setScreenSize('6.1 pouces');
        $ficheTechnique12->setProcesseur('A14 Bionic');
        $ficheTechnique12->setBatterie('2815 mAh');
        $ficheTechnique12->setPhoto('Double caméra arrière 12MP');
        $ficheTechnique12->setPoids('164 grammes');
        $ficheTechnique12->setModele($this->getReference('modele_IPhone_13'));
        $manager->persist($ficheTechnique12);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [ModeleFixtures::class];
    }
}
