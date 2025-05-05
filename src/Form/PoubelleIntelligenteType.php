<?php
namespace App\Form;

use App\Entity\Zone;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\PoubelleIntelligente;

class PoubelleIntelligenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type_dechets', TextType::class, [
                'label' => 'Type de Déchets',
                'required' => true,
            ])
            ->add('niveau_remplissage', RangeType::class, [
                'label' => 'Niveau de Remplissage (%)',
                'attr' => ['min' => 0, 'max' => 100, 'step' => 1],
            ])
            ->add('localisation', TextType::class, [
                'label' => 'Localisation',
                'required' => false,
            ])
            ->add('latitude', TextType::class, [
                'label' => 'Latitude',
                'required' => true,
            ])
            ->add('longitude', TextType::class, [
                'label' => 'Longitude',
                'required' => true,
            ])
            ->add('zoneId', EntityType::class, [
                'class' => Zone::class,
                'choice_label' => 'location', // Display the `location` field of the Zone entity
                'label' => 'Zone',
                'placeholder' => 'Choisissez une zone',
                'required' => true,
                'mapped' => false, // This prevents Symfony from trying to map it automatically
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PoubelleIntelligente::class,
        ]);
    }
}