<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
 use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
 use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
 class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
         $builder
        ->add('name', TextType::class, [
            'attr' => ['class' => 'form-control']
        ])
        ->add('prename', TextType::class, [
            'attr' => ['class' => 'form-control']
        ])
        ->add('birthday', BirthdayType::class, [
            'widget' => 'single_text',
            'attr' => ['class' => 'form-control']
        ])
        ->add('adress', TextType::class, [
            'attr' => ['class' => 'form-control']
        ])
        ->add('email', EmailType::class, [
            'attr' => ['class' => 'form-control']
        ])
        ->add('phone', TextType::class, [
            'attr' => ['class' => 'form-control']
        ])
        ->add('agreeTerms', CheckboxType::class, [
            'mapped' => false,
            'constraints' => [
                new IsTrue([
                    'message' => 'You should agree to our terms.',
                ]),
            ],
        ])
        ->add('plainPassword', PasswordType::class, [
            'mapped' => false,
            'attr' => ['class' => 'form-control', 'autocomplete' => 'new-password'],
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter a password',
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Your password should be at least {{ limit }} characters',
                    'max' => 4096,
                ]),
            ],
        ]);
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
