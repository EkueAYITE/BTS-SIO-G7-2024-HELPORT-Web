<?php

namespace App\Form;

use App\Entity\Competence;
use App\Entity\Matiere;
use App\Entity\Soutien;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompetenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('statut')
            ->add('id_competence', EntityType::class, [
                'class' => Soutien::class,
'choice_label' => 'id',
'multiple' => true,
            ])
            ->add('id_user', EntityType::class, [
                'class' => User::class,
'choice_label' => 'id',
'multiple' => true,
            ])
            ->add('id_matiere', EntityType::class, [
                'class' => Matiere::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Competence::class,
        ]);
    }
}
