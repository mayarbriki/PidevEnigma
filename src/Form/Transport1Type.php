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
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Security\Core\Security;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class Transport1Type extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $this->security->getUser();
        
        $builder
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'SUV/4X4' => 'SUV/4X4',
                    'Utilitaire' => 'Utilitaire',
                    'Monospace' => 'Monospace',
                    'Pick Up' => 'Pick up',
                    'Camion frigorifique' => 'Camion Frigorifique',
                ],
            ])
            ->add('marque', ChoiceType::class, [
                'choices' => [
                    'Hyundai' => 'HYUNDAI',
                    'Kia' => 'KIA',
                    'Toyota' => 'TOYOTA',
                    'Peugeot' => 'PEUGEOT',
                    'Suzuki' => 'SUZUKI',
                    'Isuzu' => 'ISUZU',
                    'Fiat' => 'FIAT',
                    'Volkswagen' => 'VOLKSWAGEN',
                ],
            ])
            ->add('matricule', TextType::class, [
                'label' => 'Matricule',
                'required' => false, // Adjust as needed
                'constraints' => [
                    new NotBlank([
                        'message' => 'Matricule ne peut pas être vide',
                    ]),
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'Matricule ne peut pas être plus long que {{ limit }} caractères',
                    ]),
                    new Regex([
                        'pattern' => '/^\d{3}-TUN-\d{4}$/',
                        'message' => 'Le matricule doit être au format XXX-TUN-XXXX',
                    ]),
                ],
            ])
            ->add('anneefab', DateType::class, [
                'widget' => 'single_text',
                'html5' => true,
                'attr' => [
                    'min' => 'yyyy-01-01', // Set minimum date
                    'max' => 'yyyy-12-31', // Set maximum date
                ],
            ])
            ->add('etat', ChoiceType::class, [
                'choices' => [
                    'Opérationnel' => 'opérationnel',
                    'En réparation' => 'En Réparation',
                    'Hors service' => 'Hors Service',
                ],
            ])
            ->add('livreur', EntityType::class, [
                'class' => User::class,
                'choices' => [$user],
                'choice_label' => 'name', // Adjust this to the actual field representing the username
                'disabled' => true,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transport::class,
        ]);
    }
}
