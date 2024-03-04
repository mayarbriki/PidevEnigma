<?php

namespace App\Form;

use App\Entity\Stock;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Fournisseur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType as DoctrineEntityType;
use Symfony\Component\Validator\Constraints\Length; 

class StockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_produit', TextType::class, [
                'label' => 'Product Name',
                'attr' => ['placeholder' => 'Enter the product name'], // Example: Adding a placeholder
                'constraints' => [
                  
                    new Length([
                        'min' => 1,
                        'max' => 255,
                        'minMessage' => 'Product name must be at least {{ limit }} character long',
                        'maxMessage' => 'Product name cannot be longer than {{ limit }} characters',
                    ]),
                ],
            ])
            ->add('quantite_entre', IntegerType::class, [
                'label' => 'Quantity In',
                'attr' => ['placeholder' => 'Enter the quantity in'],
            ])
            ->add('quantite_sortie', IntegerType::class, [
                'label' => 'Quantity Out',
                'attr' => ['placeholder' => 'Enter the quantity out'],
            ])
            ->add('quantite_restante', IntegerType::class, [
                'label' => 'Remaining Quantity',
                'attr' => ['placeholder' => 'Enter the remaining quantity'],
            ])
            ->add('date', DateType::class, [
                'label' => 'Date',
                'widget' => 'single_text', // Example: Render the date as a single text input
                'attr' => ['placeholder' => 'Select the date'],
            ])
            ->add('fournisseur', DoctrineEntityType::class, [
                'label' => 'Supplier',
                'class' => Fournisseur::class,
                'choice_label' => function ($fournisseur) {
                    return $fournisseur->getNom() . ' ' . $fournisseur->getPrenom();
                },
                'attr' => ['class' => 'form-select'], // Example: Adding a CSS class to the select input
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stock::class,
        ]);
    }
}



