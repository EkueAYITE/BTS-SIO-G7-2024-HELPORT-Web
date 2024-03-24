<?php

// src/Form/UserPasswordConfirmationType.php
namespace App\Form;

use App\Entity\UserPasswordConfirmation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class    TestForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password', PasswordType::class, [
                'label' => 'Nouveau mot de passe',
                'attr' => [
                    'pattern' => '(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}',
                    'title' => 'Le mot de passe doit contenir au moins 8 caractères, dont au moins un chiffre, une minuscule et une majuscule.',
                    'required' => true,
                ],
            ])
            ->add('confirmPassword', PasswordType::class, [
                'label' => 'Confirmer le mot de passe',
                'attr' => [
                    'required' => true,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserPasswordConfirmation::class,
        ]);
    }
}
