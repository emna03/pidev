<?php
// src/Form/LampadaireType.php

namespace App\Form;

use App\Entity\Lampadaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class LampadaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('localisation', TextType::class)
            ->add('etat', CheckboxType::class, [
                'label' => 'Is active?',
                'required' => false,
            ])
            ->add('consommation', NumberType::class)
            ->add('idQuartier', IntegerType::class, [
                'label' => 'Quartier ID'
            ])
            ->add('dateInstallation', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Installation Date'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lampadaire::class,
        ]);
    }
}