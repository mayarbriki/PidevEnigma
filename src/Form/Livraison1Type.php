<?php

namespace App\Form;

use App\Entity\Livraison;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
         ->add('adresseLiv')
        ->add('description', ChoiceType::class, [
            'label' => 'Description',
            'required' => true,
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
        ->add('livreur', EntityType::class, [
            'class' => User::class,
            'label' => 'Choisissez un livreur',
            'choice_label' => function($user) {
                return $user->/*getEmail() . ' - ' . $user->getAdress();*/getName();
            },
            'query_builder' => function ($userRepository) {
                return $userRepository->createQueryBuilder('u')
                    ->where('u.roles LIKE :role')
                    ->setParameter('role', '%"ROLE_LIVREUR"%');
            },
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livraison::class,
        ]);
    }
}