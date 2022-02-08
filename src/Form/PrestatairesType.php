<?php

namespace App\Form;

use App\Entity\Prestataires;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PrestatairesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('telephone')
            ->add('mail')
            ->add('site')
            ->add('description')
            ->add(
                'image',
                FileType::class,
                [
                    'label' => 'Charger une image',
                    'data_class' => null,
                    'required' => false,
                    'empty_data' => ''
                ]
            )
            ->add('position');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prestataires::class,
        ]);
    }
}
