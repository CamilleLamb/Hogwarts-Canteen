<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Ajout des champs du formulaire
        $builder
            ->add('email')
            ->add('roles')
            ->add('password')
            ->add('firstname')
            ->add('role')
            ->add('lastname')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        // Configuration des options du formulaire avec la classe User
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
