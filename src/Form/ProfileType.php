<?php
// src/Form/ProfileType.php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder
    ->add('nom', TextType::class, [
        'required' => false,
        'empty_data' => '', // 👈 important pour JS-only validation
    ])
    ->add('prenom', TextType::class, [
        'required' => false,
        'empty_data' => '',
    ])
    ->add('email', EmailType::class, [
        'required' => false,
        'empty_data' => '',
    ])
    
    ->add('numero_telephone', TextType::class, [
        'label' => 'Numéro de téléphone',
        'required' => false,
        'empty_data' => '', // 👈 ajouté ici aussi
    ])
    ->add('photo_profil', FileType::class, [
        'label' => 'Photo de profil',
        'mapped' => false,
        'required' => false,
        'constraints' => [
            new File([
                'maxSize' => '2M',
                'mimeTypes' => [
                    'image/jpeg',
                    'image/png',
                    'image/gif',
                ],
                'mimeTypesMessage' => 'Veuillez télécharger une image valide (JPEG, PNG, GIF)',
            ])
        ],
    ]);
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
