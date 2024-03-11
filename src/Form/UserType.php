<?php

namespace App\Form;

use App\Entity\Competence;
use App\Entity\Demande;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles')
            ->add('password')
            ->add('nom')
            ->add('prenom')
            ->add('niveau')
            ->add('sexe')
            ->add('telephone')
            ->add('competences', EntityType::class, [
                'class' => Competence::class,
'choice_label' => 'id',
'multiple' => true,
            ])
            ->add('demande', EntityType::class, [
                'class' => Demande::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
