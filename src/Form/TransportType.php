<?php

namespace App\Form;

use App\Entity\Transport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class TransportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('type', ChoiceType::class, [
            'choices' => [
                'Velo' => 'velo',
                'Moto' => 'moto',
                'Voiture' => 'voiture',
            ],
        ])
        ->add('etat', ChoiceType::class, [
            'choices' => [
                'Disponible' => 'disponible',
                'Non-disponible' => 'non-disponible',
                'En-livraison' => 'en-livraison',
            ],
        ])
            ->add('status')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transport::class,
        ]);
    }
}
