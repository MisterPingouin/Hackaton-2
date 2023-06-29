<?php

namespace App\Form;

use App\Entity\Marque;
use App\Entity\Modele;
use App\Repository\ModeleRepository;
use App\Repository\MarqueRepository;
use App\Entity\Phone;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('marque', EntityType::class, [
                'class' => Marque::class,
                'query_builder' => function (MarqueRepository $marqueRepository) {
                    return $marqueRepository->createQueryBuilder('u')->orderBy('u.name', 'ASC');
                },
                'label' => false,
                'choice_label' => 'name',
                'multiple' => false,
                'required' => true,
                'placeholder' => 'Marque',
            ])
            ->add('modele', EntityType::class, [
                'class' => Modele::class,
                'query_builder' => function (ModeleRepository $modeleRepository) {
                    return $modeleRepository->createQueryBuilder('u')->orderBy('u.name', 'ASC');
                },
                'label' => false,
                'choice_label' => 'name',
                'multiple' => false,
                'required' => true,
                'placeholder' => 'Modèle',
            ])
            ->add('ram', ChoiceType::class, [
                'choices' => $this->getRamChoices(),
                'label' => false,
                'placeholder' => 'RAM (go)',
            ])
            ->add('stockage', ChoiceType::class, [
                'choices' => $this->getStockageChoices(),
                'label' => false,
                'placeholder' => 'Stockage (go)',
            ])
            ->add('etat', ChoiceType::class, [
                'choices' => $this->getEtatChoices(),
                'label' => false,
                'placeholder' => "Etat de l'appareil",
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Phone::class,
        ]);
    }

    private function getStockageChoices(): array
    {
        $choices = ['8' => '8', '16' => '16', '32' => '32', '64' => '64', '128' => '128', '256' => '256'];
        $output = [];
        foreach ($choices as $k => $v) {
            $output[$v] = $k;
        }
        return $output;
    }

    private function getRamChoices(): array
    {
        $choices = ['2' => '2', '4' => '4', '6' => '6', '8' => '8', '10' => '10', '12' => '12'];
        $output = [];
        foreach ($choices as $k => $v) {
            $output[$v] = $k;
        }
        return $output;
    }

    private function getEtatChoices(): array
    {
        $choices = [
            '0' => 'Déféctueux',
            '3' => 'Réparable',
            '4' => 'Bloqué',
            '5' => 'Mauvais état',
            '7' => 'Etat convenable',
            '8' => 'Bon état',
            '10' => 'Très bon état'
        ];
        $output = [];
        foreach ($choices as $k => $v) {
            $output[$v] = $k;
        }
        return $output;
    }
}
