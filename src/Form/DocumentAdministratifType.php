<?php

namespace App\Form;

use App\Entity\Documentadministratif;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class DocumentAdministratifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomDocument', TextType::class, [
                'label' => 'Nom du document',
                'attr' => ['maxlength' => 255]
            ])
            ->add('cheminFichier', FileType::class, [
                'label' => 'Fichier (PDF, DOC, etc.)',
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/msword',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        ],
                        'mimeTypesMessage' => 'Veuillez uploader un fichier PDF ou Word valide.',
                    ])
                ],
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Statut',
                'choices' => [
                    'Brouillon' => 'Brouillon',
                    'Validé' => 'Validé',
                    'Archivé' => 'Archivé',
                    'Rejeté' => 'Rejeté'
                ],
                'placeholder' => 'Choisir un statut'
            ])
            ->add('remarque', TextareaType::class, [
                'label' => 'Remarque',
                'required' => false,
                'attr' => ['maxlength' => 255, 'rows' => 3]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Documentadministratif::class,
        ]);
    }
}