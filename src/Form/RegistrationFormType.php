<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('lastname', TextType::class, [
            'label' => 'Nom de famille',
            'attr' => [
                'class' => 'form-control'
            ]
        ])
        ->add('firstname', TextType::class, [
            'label' => 'Prénom',
            'attr' => [
                'class' => 'form-control'
            ]
        ])
            ->add('email',  TextType::class, [
            'label' => 'Email',
            'attr' => [
                'class' => 'form-control'
            ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                //référence aux 
                //TODO: inverser la case à cocher avec le label
                'label' => 'Je jure solennellement que mes intentions sont mauvaises ! ',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez cocher la case pour valider le formulaire',
                    ]),
                ],
                
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password',
                'class' => 'form-control'
            ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit être composé d\'au moins ??? caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}