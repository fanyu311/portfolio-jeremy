<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Portfolio;
use App\Form\PortfolioImageType;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class PortfolioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre:',
                'required' => true,
                'sanitize_html' => true,
                'attr' => [
                    'placeholder' => 'votre titre...',
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Content:',
                'required' => true,
                'sanitize_html' => true,
                'attr' => [
                    'placeholder' => 'créer content...',
                    'rows' => 5,
                ]
            ])
            ->add('metaTitle', TextType::class, [
                'label' => 'MetaTitle:',
                'required' => true,
                'sanitize_html' => true,
                'attr' => [
                    'placeholder' => 'metaTitle...',
                ]
            ])
            ->add('metaDescription', TextType::class, [
                'label' => 'MetaDesc:',
                'required' => true,
                'sanitize_html' => true,
                'attr' => [
                    'placeholder' => 'MetaDescription...',
                ]
            ])
            ->add('image', VichImageType::class, [
                'label' => 'Image:',
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Supprimer l\'image',
                'image_uri' => true,
                'download_uri' => false,


            ])
            ->add('categories', EntityType::class, [
                'label' => 'Catégories:',
                'class' => Categorie::class,
                'choice_label' => 'titre',
                'expanded' => false,
                'multiple' => true,
                'autocomplete' => true,
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Portfolio::class,
        ]);
    }
}
