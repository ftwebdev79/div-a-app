<?php

namespace App\Form;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\Song;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SongType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class,
            [
                'label'=> 'Titre'
            ])
            ->add('duration', TextType::class, [
                'label'=> 'Durée'
            ])
            ->add('albums', EntityType::class, [
                'class' => Album::class,
                'label' => 'Album(s)',
                'choice_label' => 'title',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
            ]  )
            ->add('styles', EntityType::class, [
                'class' => Album::class,
                'label' => 'Album(s)',
                'choice_label' => 'title',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
            ] )
            ->add('artists', EntityType::class, [
                'class' => Artist::class,
                'label' => 'Artiste(s)',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
            ])
//            ->add('playlists')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Song::class,
        ]);
    }
}
