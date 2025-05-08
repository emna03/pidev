<?php

namespace App\Form;

use App\Entity\Lampadaire;
use App\Entity\Quartier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class LampadaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('localisation', TextType::class, [
                'label' => 'Localisation'
            ])
            ->add('etat', ChoiceType::class, [
                'label' => 'État',
                'choices' => [
                    'Actif' => true,
                    'Inactif' => false,
                ],
                'expanded' => false, // menu déroulant
                'multiple' => false,
            ])
            ->add('consommation', NumberType::class, [
                'label' => 'Consommation (kWh)'
            ])
            ->add('quartier', EntityType::class, [
                'class' => Quartier::class,
                'choice_label' => 'nom',
                'placeholder' => 'Sélectionner un quartier',
                'label' => 'Quartier'
            ])
            ->add('dateInstallation', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date d\'installation'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lampadaire::class,
        ]);
    }
}
