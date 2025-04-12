<?php

namespace App\Form;

use App\Entity\Assistantdocumentaire;
use App\Entity\Utilisateur;
use App\Entity\Documentadministratif;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssistantDocumentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('utilisateur', EntityType::class, [
                'class' => Utilisateur::class,
                'choice_label' => function (Utilisateur $utilisateur) {
                    return $utilisateur->getNom() . ' ' . $utilisateur->getPrenom();
                },
                'label' => 'Utilisateur'
            ])
            ->add('document', EntityType::class, [
                'class' => Documentadministratif::class,
                'choice_label' => 'nomDocument',
                'label' => 'Document administratif',
                'required' => false, // Matches your nullable relation
                'placeholder' => 'Sélectionnez un document',
                'attr' => ['class' => 'select2']
            ])
            ->add('typeAssistance', ChoiceType::class, [
                'label' => 'Type d\'assistance',
                'choices' => [
                    'Correction' => 'Correction',
                    'Vérification' => 'Vérification',
                    'Complétion' => 'Complétion',
                    'Traduction' => 'Traduction',
                    'Autre' => 'Autre'
                ],
                'placeholder' => 'Sélectionnez un type',
                'attr' => ['class' => 'form-control']
            ])
            ->add('dateDemande', DateType::class, [
                'label' => 'Date de demande',
                'widget' => 'single_text',
                'html5' => true
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Statut',
                'choices' => [
                    'Pending' => 'Pending',
                    'Approved' => 'Approved',
                    'Rejected' => 'Rejected'
                ],
                'placeholder' => 'Sélectionnez un statut'
            ])
            ->add('remarque', TextareaType::class, [
                'label' => 'Remarque',
                'required' => false,
                'attr' => ['rows' => 4]
            ])
            ->add('rappelAutomatique', CheckboxType::class, [
                'label' => 'Activer le rappel automatique',
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Assistantdocumentaire::class,
        ]);
    }
}