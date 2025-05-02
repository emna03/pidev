<?php

namespace App\Form;

use App\Entity\Incident;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class IncidentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Champ pour le type de l'incident
            ->add('typeIncident', ChoiceType::class, [
                'choices' => [
                    'Vol' => 'Vol',
                    'Accident' => 'Accident',
                    'Panne' => 'Panne',
                    'Incendie' => 'Incendie',
                    'Autre' => 'Autre',
                ],
                'label' => 'Type d\'incident',
                'placeholder' => 'Sélectionnez un type',
                'attr' => [
                    'class' => 'form-control form-select'
                ]
            ])
            // Champ pour la description de l'incident
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => ['rows' => 4],
            ])
            
            // Champ pour la localisation de l'incident
            ->add('localisation', TextType::class, [
                'label' => 'Localisation',
            ])
            
            // Champ pour l'upload de l'image (facultatif)
            ->add('image', FileType::class, [
                'label' => 'Image (facultatif)',
                'mapped' => false,
                'required' => false,
            ])
            
            // Champs cachés pour latitude et longitude
            ->add('latitude', HiddenType::class)
            ->add('longitude', HiddenType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Incident::class,
        ]);
    }
}
