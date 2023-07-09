<?php

namespace App\Form;

use App\Entity\Children;
//classe de données pour le formulaire
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
//créer des listes déroulantes dans le formulaire
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
//créer des champs numériques dans le formulaire
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
// construire le formulaire
use Symfony\Component\Form\FormBuilderInterface;
//configurer les options du formulaire
use Symfony\Component\OptionsResolver\OptionsResolver;
//contrainte Range pour valider les valeurs numériques
use Symfony\Component\Validator\Constraints\Range;

class ChildrenType extends AbstractType
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
            // Spécificité de Poudlard : on change Age pour Année, car l'âge ne détermine pas l'année à laquelle l'élève appartient
            ->add('age', IntegerType::class, [
                'label' => 'Année',
                'attr' => [
                    'class' => 'form-control'
                ],
                // Range : oblige l'utilisateur à saisir une classe entre 1 et 7
                'constraints' => [
                    new Range([
                        'min' => 1,
                        'max' => 7,
                        'notInRangeMessage' => 'Entrer une année entre 1 et 7',
                    ]),
                ],
            ])
            ->add('house', ChoiceType::class, [
                'label' => 'Maison',
                // placeholder pour ne pas suggérer une maison par défaut
                'placeholder' => 'Sélectionner une Maison',
                'attr' => [
                    'class' => 'form-control'
                ],
                // choix de la Maison de l'élève
                'choices'  => [
                    'Gryffondor' => 'Gryffondor',
                    'Serdaigle' => 'Serdaigle',
                    'Poufsouffle' => 'Poufsouffle',
                    'Serpentard' => 'Serpentard'
                ]
            ])
        ;
    }
    // Fonction pour configurer les options du formulaire
    public function configureOptions(OptionsResolver $resolver): void
    {
        // Spécification des options par défaut pour le formulaire
        $resolver->setDefaults([
            // La classe de données utilisée pour le formulaire est Children
            'data_class' => Children::class,
        ]);
    }
}
