<?php

namespace App\Form;

use App\Entity\Livraison;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class Livraison1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('dateliv', DateType::class, [
            'label' => 'Dateliv',
            'required' => false,
            'widget' => 'single_text',
            'html5' => true,
            'attr' => [
                'min' => 'yyyy-01-01', // Set minimum date
                'max' => 'yyyy-12-31', // Set maximum date
            ],
            'constraints' => [
                new NotBlank(['message' => 'The date of delivery cannot be blank.']), // Add NotBlank constraint with custom message
            ],
        ])
        ->add('adresseLiv', TextType::class, [
            'label' => 'AdresseLiv',
            'required' => false,
            'constraints' => [
                new Regex([
                    'pattern' => '/^[a-zA-Z0-9\s\-\,]+$/',
                    'message' => "L'adresse ne doit contenir que des lettres, des chiffres, des espaces, des traits d'union et des virgules."
                ]),
                new NotBlank([
                    'message' => "L'adresse de livraison ne peut pas être vide",
                ]),
            ],
        ])
        ->add('description', ChoiceType::class, [
            'label' => 'Description',
            'required' => false,
            'choices' => [
                "Déposez le colis à la porte d'entrée" => "Déposez le colis à la porte d'entrée",
                "Appeler à l'arrivée" => "Appeler à l'arrivée",
                'Manipuler avec soin' => 'Manipuler avec soin',
                'Signature requise' => 'Signature requise',
            ],
            'constraints' => [
                new NotBlank([
                    'message' => "La description ne peut pas être vide",
                ]),
            ],
        ])
            ->add('etat')
            ->add('reference')
            ->add('matricule')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livraison::class,
        ]);
    }
}
