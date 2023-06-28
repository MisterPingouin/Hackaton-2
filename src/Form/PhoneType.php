<?php

namespace App\Form;

use App\Entity\Marque;
use App\Entity\Modele;
use App\Repository\ModeleRepository;
use App\Repository\MarqueRepository;
use App\Entity\Phone;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
                'label' => 'Marque:',
                'choice_label' => 'name',
                'multiple' => false,
                'required' => true
            ])
            ->add('modele', EntityType::class, [
                'class' => Modele::class,
                'query_builder' => function (ModeleRepository $modeleRepository) {
                    return $modeleRepository->createQueryBuilder('u')->orderBy('u.name', 'ASC');
                },
                'label' => 'Modele:',
                'choice_label' => 'name',
                'multiple' => false,
                'required' => true
            ])
            ->add('ram')
            ->add('stockage');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Phone::class,
        ]);
    }
}
