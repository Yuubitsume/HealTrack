<?php

namespace App\Form;

use App\Entity\Exercice;
use App\Entity\Maladie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaladieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['required' => true, 'attr' => ['required' => true, 'placeholder' => 'Nom de la maladie', 'class' => 'form-control']])
            ->add('description', TextareaType::class, ['required' => false, 'attr' => ['required' => false, 'placeholder' => 'Description', 'class' => 'form-control']])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Maladie::class,
        ]);
    }
}
