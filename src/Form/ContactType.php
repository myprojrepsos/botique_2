<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['user'];

        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Votre prénom',
                'data' => $user ? $user->getFirstname() : ''
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Votre nom',
                'data' => $user ? $user->getLastname() : ''
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre email',
                'data' => $user ? $user->getEmail() : ''
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Votre message', 
                'attr' => [
                    'placeholder' => 'En quoi pouvons-nous vous aider ?'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'btn btn-sm btn-light float-right'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
            'user' => array()
        ]);
    }
}
