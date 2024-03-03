<?php

namespace App\Form;

use App\Entity\Livraison;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\User;
use App\Entity\Transport;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class Livraison2Type extends AbstractType
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
                ->add('dateLiv', null, [
                    'disabled' => true, // Disable editing
                ])
                ->add('adresseLiv', null, [
                    'disabled' => true, // Disable editing
                ])
                ->add('description', null, [
                    'disabled' => true, // Disable editing
                ])
                ->add('etat', null, [
                    'disabled' => true, // Disable editing
                ])
                ->add('reference', null, [
                    'disabled' => true, // Disable editing
                ])
                ->add('livreur', EntityType::class, [
                    'class' => User::class,
                    'choices' => [$user],
                    'choice_label' => 'name', // Adjust this to the actual field representing the username
                    'disabled' => true,
                ])
                ->add('matricule', EntityType::class, [
                    'class' => Transport::class,
                    'choice_label' => 'matricule', // Adjust this to the actual field representing the matricule
                ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livraison::class,
        ]);
    }
}
