<?php

namespace App\Form;

use App\Entity\Portfolio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PortfolioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'portfolio.title.label',
                'required' => true,
                'sanitize_html' => true,
                'attr' => [
                    'placeholder' => 'portfolio.title.placeholder',
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'portfolio.content.label',
                'required' => true,
                'sanitize_html' => true,
                'attr' => [
                    'placeholder' => 'portfolio.content.placeholder',
                    'rows' => 5,
                ]
            ])
            ->add('metaTitle', TextType::class, [
                'label' => 'portfolio.metaTitle.label',
                'required' => true,
                'sanitize_html' => true,
                'attr' => [
                    'placeholder' => 'portfolio.metaTitle.placeholder',
                ]
            ])
            ->add('metaDescription', TextType::class, [
                'label' => 'portfolio.metaDesc.label',
                'required' => true,
                'sanitize_html' => true,
                'attr' => [
                    'placeholder' => 'portfolio.metaDesc.placeholder',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Portfolio::class,
        ]);
    }
}
