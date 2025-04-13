<?php
// src/Form/CamionCollecteType.php

namespace App\Form;

use App\Entity\CamionCollecte;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CamionCollecteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('capaciteMax', NumberType::class, [
                'label' => 'Capacité maximale',
                'attr' => ['class' => 'form-control']
            ])
            ->add('statut', ChoiceType::class, [
                'label' => 'Statut',
                'choices' => [
                    'Disponible' => 'Disponible',
                    'En maintenance' => 'En maintenance',
                    'En mission' => 'En mission',
                    'Hors service' => 'Hors service',
                ],
                'attr' => ['class' => 'form-control']
            ])
            ->add('zoneId', NumberType::class, [
                'label' => 'Zone ID',
                'attr' => ['class' => 'form-control']
            ])
            ->add('modele', TextType::class, [
                'label' => 'Modèle',
                'attr' => ['class' => 'form-control']
            ])
            ->add('immatriculation', TextType::class, [
                'label' => 'Immatriculation',
                'attr' => ['class' => 'form-control']
            ])
            ->add('kilometrage', NumberType::class, [
                'label' => 'Kilométrage',
                'attr' => ['class' => 'form-control']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CamionCollecte::class,
        ]);
    }
}