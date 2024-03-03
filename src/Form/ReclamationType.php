<?php

namespace App\Form;

use App\Entity\Reclamation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


class ReclamationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
      //  $builder
           // ->add('titre')
           // ->add('dateR')
           // ->add('descriptionR')
           // ->add('statusR')
       // ;
        $builder
            ->add('titre', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('descriptionR', TextareaType::class, [
                'constraints' => [
                    new NotBlank(),
                ]
                ])
                ->add('dateR', DateTimeType::class, [
                    'disabled' => true, // Désactiver la modification de la date
                ])
                ->add('statusR', TextType::class, [
                    'disabled' => true, // Désactiver la modification du statut
                ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
    
    
}