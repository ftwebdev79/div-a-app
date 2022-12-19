<?php

namespace App\Form;

use App\Entity\Artist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,
            [
                'label'=> "Prénom et Nom de l'artiste ou nom du groupe",
                'required'=> true
            ])
            ->add('firstReleasedAt', DateType::class, [
                'label'=> 'Date de la première sortie',
                'required'=> true,
                'widget'=> 'single_text'
            ])
            ->add('description', TextareaType::class,
            [
                'label' => "Information sur l'artiste",
                'required'=> false
            ])

            ->add('createdAt', DateType::class, [
                'label'=> 'Ajouter le :',
                'widget'=> 'single_text'
            ])

            ->add('imageFile', FileType::class, [
                'mapped'=> false

            ])
//            ->add('image', FileType::class, [
//                'label'=> 'Ajouter une image',
//                'mapped'=> false,
////                'required'=>false
//            ])
//            ->add('albums')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artist::class,
        ]);
    }
}
