<?php

namespace App\Form;

use App\Entity\Quartier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class QuartierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom du quartier',
                'attr' => ['class' => 'form-control']
            ])
            ->add('consomTot', NumberType::class, [
                'label' => 'Consommation totale',
                'attr' => ['class' => 'form-control'],
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Quartier::class,
        ]);
    }
}