<?php

namespace App\Form;

use App\Entity\Album;
use App\Entity\Artist;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class AlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label'=> "Titre de l'album"
            ])
            ->add('duration', TextType::class, [
                'label'=> "Durée de l'album"
            ])
            ->add('releasedAt', DateType::class, [
                'label' => 'Date de sortie',
                'widget'=> 'single_text'
            ])
            ->add('coverFile', FileType::class, [
                'label' => 'Couverture',
                'mapped' => false,
                'constraints'=> new File(
                    maxSize: '2048k',
                    mimeTypes: ['image/jpeg', 'image/png'],
                    mimeTypesMessage: 'Thanks to upload a jpeg or png file',
                )
            ])

            ->add('artists', EntityType::class, [
                'class' => Artist::class,
                'label' => 'Artiste(s)',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Album::class,
        ]);
    }
}
