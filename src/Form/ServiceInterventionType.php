<?php

namespace App\Form;

use App\Entity\ServiceIntervention;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceInterventionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomService', TextType::class, [
                'label' => 'Nom du service',
            ])
            ->add('typeIntervention', TextType::class, [
                'label' => 'Type d\'intervention',
            ])
            ->add('zoneIntervention', TextType::class, [
                'label' => 'Zone d\'intervention',
            ]);
           
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ServiceIntervention::class,
        ]);
    }
}
