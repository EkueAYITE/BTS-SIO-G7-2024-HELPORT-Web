<?php

namespace App\Form;

use App\Entity\Demande;
use App\Entity\Matiere;
use App\Entity\Soutien;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Demande1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_uptaded')
            ->add('date_fin_demande')
            ->add('statut')
            ->add('Sous_matiere')
            ->add('soutien', EntityType::class, [
                'class' => Soutien::class,
'choice_label' => 'id',
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
            'data_class' => Demande::class,
        ]);
    }
}
