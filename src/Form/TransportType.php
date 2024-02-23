<?php

namespace App\Form;

use App\Entity\Transport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

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
        ->add('DelaiLivMoy', TextType::class, [
            'label' => 'Average Delivery Time',
            'constraints' => [
                new Regex([
                    'pattern' => '/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/',
                    'message' => 'The delivery time must be in the format HH:MM',
                ]),
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transport::class,
        ]);
    }
}
