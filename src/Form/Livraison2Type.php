<?php

namespace App\Form;

use App\Entity\Livraison;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Livraison2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
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
                ->add('Nom')
                ->add('matricule', null, [
                    'disabled' => true, // Disable editing
                ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livraison::class,
        ]);
    }
}
