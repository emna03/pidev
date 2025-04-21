<?php

namespace App\Form;

use App\Entity\DeclarationRevenus;
use App\Entity\DossierFiscale;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DossierFiscaleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('annee_fiscale')
            ->add('total_impot')
            ->add('total_impot_paye')
            ->add('status')
            ->add('date_creation')
            ->add('moyen_payement')
            ->add('id_declaration', EntityType::class, [
                'class' => DeclarationRevenus::class,
'choice_label' => 'id',
            ])
            ->add('user', EntityType::class, [
                'class' => Utilisateur::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DossierFiscale::class,
        ]);
    }
}
