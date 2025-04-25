<?php

namespace App\Form;

use App\Entity\Incident;
use App\Entity\ServiceIntervention;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class StatutIncidentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('statut', ChoiceType::class, [
                'choices' => [
                    'En attente' => 'En attente',
                    'En cours' => 'En cours',
                    'Résolu' => 'Résolu',
                ],
                'placeholder' => 'Choisissez un statut',
                'label' => 'Statut de l\'incident',
                'attr' => [
                    'class' => 'form-control form-select'
                ]
            ])
            ->add('serviceAffecte', EntityType::class, [
                'class' => ServiceIntervention::class,
                'choice_label' => 'nomService', // ou ce que tu veux afficher dans le select
                'placeholder' => 'Choisir un service',
                'required' => false,
                'label' => 'affecter une service',
                'attr' => ['class' => 'form-control form-select']
            ]);
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Incident::class,
        ]);
    }
}
