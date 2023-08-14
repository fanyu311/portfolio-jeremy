<?php

namespace App\Form;

use App\Entity\Portfolio;
use App\Form\PortfolioImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

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
            ->add('images', CollectionType::class, [
                'entry_type' => PortfolioImageType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'delete_empty' => true,
                'by_reference' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Portfolio::class,
        ]);
    }
}
