<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Prénom:',
                'attr' => [
                    'placeholder' => 'John'
                ],
                'required' => true
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom:',
                'attr' => [
                    'placeholder' => 'Doe'
                ],
                'required' => true
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email:',
                'attr' => [
                    'placeholder' => 'john@example.com'
                ],
                'required' => true
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Present:',
                'required' => true,
                'sanitize_html' => true,
                'attr' => [
                    'placeholder' => 'Ce que vous voulez me dire ...',
                    'rows' => 20,
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
