<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['required' => true, 'attr' => ['required' => true, 'placeholder' => 'Nom de famille', 'class' => 'form-control']])
            ->add('lastname', TextType::class, ['required' => true, 'attr' => ['required' => true, 'placeholder' => 'Prénoms', 'class' => 'form-control']])
            
            ->add('birthDay', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => ['required' => false, 'class' => 'form-control', 'type' => 'datetime', 'id' => 'select23', 'style' => 'width:100%'],
            ])
            ->add('sex', ChoiceType::class, [
                'choices' => [
                    'Masculin' => 'Masculin',
                    'Féminin' => 'Féminin',
                ],

                'attr' => ['required' => true, 'data-placeholder' => 'Sexe', 'class' => 'form-control select2', 'id' => 'select23', 'style' => 'width:100%'],
        
             ])
             ->add('email', EmailType::class, ['required' => true, 'attr' => ['required' => true, 'placeholder' => 'Email', 'class' => 'form-control']])
            ->add('insuranceNumber', TextType::class, ['required' => false, 'attr' => ['required' => false, 'placeholder' => 'Numéro d\' assurance', 'class' => 'form-control']])
            ->add('password', PasswordType::class, ['required' => true, 'attr' => ['required' => true, 'placeholder' => 'Mot de passe', 'class' => 'form-control']])
            ->add('speciality', TextType::class, ['required' => false, 'attr' => ['required' => false, 'placeholder' => 'Spécialité', 'class' => 'form-control']])
            ->add('phone', TextType::class, ['required' => true, 'attr' => ['required' => true, 'placeholder' => 'Téléphone', 'class' => 'form-control']])
            ->add('address', TextType::class, ['required' => true, 'attr' => ['required' => true, 'placeholder' => 'Adresse', 'class' => 'form-control']])
            ->add('biography', TextType::class, ['required' => false, 'attr' => ['required' => false, 'placeholder' => 'Biographie', 'class' => 'form-control']])
            ->add('photo', FileType::class, [
                'label' => 'Photos',
                'mapped' => false,
                'required' => false,
                'multiple' => false,
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
