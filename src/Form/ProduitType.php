<?php

namespace App\Form;

use App\Entity\Produit;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
             ->add('nom')
             ->add('description')
             ->add('quantite')
             ->add('prix')
             ->add('image',  FileType::class, [
                'label' => 'image de produit (des fichiers images uniquement)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                //'constraints' => [
                 //   new File([
                        
                  //      'mimeTypes' => [
                   //         'image/jpg',
                    //        'image/png',
                    //        'image/gif',
                      //  ],
                    //    'mimeTypesMessage' => 'Please upload a valid image',
                    //])
                //],
            ])
            ->add('Categorys', null, [
                'required' => true,
                // Add any other options you may need
            ])
            

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
