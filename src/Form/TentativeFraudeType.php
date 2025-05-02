<?php

namespace App\Form;

use App\Entity\DeclarationRevenus;
use App\Entity\TentativeFraude;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TentativeFraudeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type_fraude')
            ->add('declaration', EntityType::class, [
                'class' => DeclarationRevenus::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TentativeFraude::class,
        ]);
    }
}
