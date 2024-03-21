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

            ->add('id_matiere', EntityType::class, [
                'class' => Matiere::class,
                'choice_label' => 'designation',
            ])

            ->add('sousMatiere')


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Competence::class,
        ]);
    }
}
