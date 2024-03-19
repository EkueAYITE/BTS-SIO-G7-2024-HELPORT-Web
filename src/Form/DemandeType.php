<?php

namespace App\Form;

use App\Entity\Demande;
use App\Entity\Matiere;
use App\Entity\Soutien;
use Doctrine\DBAL\Types\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class DemandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_fin_demande')
            ->add('SousMatiere')
            ->add('id_matiere', EntityType::class, [
                'class' => Matiere::class,
                'choice_label' => fn(Matiere $matiere): string => $matiere->getDesignation(),
                'placeholder' => 'Choisir une matière',
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
