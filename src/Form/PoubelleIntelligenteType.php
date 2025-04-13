<?php
// src/Form/PoubelleIntelligenteType.php

namespace App\Form;

use App\Entity\PoubelleIntelligente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PoubelleIntelligenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type_dechets', TextType::class)
            ->add('niveau_remplissage', NumberType::class)
            ->add('localisation', TextType::class, ['required' => false])
            ->add('latitude', NumberType::class)
            ->add('longitude', NumberType::class)
            ->add('zoneId', IntegerType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PoubelleIntelligente::class,
        ]);
    }
}