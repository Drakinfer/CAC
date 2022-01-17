<?php

namespace App\Form;

use App\Entity\Entreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('forme')
            ->add('adresse')
            ->add('codepostal')
            ->add('ville')
            ->add('pays')
            ->add('siret')
            ->add('telephone')
            ->add('mail')
            ->add('portable')
            ->add('heure_ouverture')
            ->add('heure_fermeture')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entreprise::class,
        ]);
    }
}
