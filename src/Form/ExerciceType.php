<?php

namespace App\Form;

use App\Entity\Exercice;
use App\Entity\Maladie;
use App\Repository\MaladieRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExerciceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['required' => true, 'attr' => ['required' => true, 'placeholder' => 'Nom de l\'exercice', 'class' => 'form-control']])
            ->add('description', TextareaType::class, ['required' => false, 'attr' => ['required' => false, 'placeholder' => 'Description', 'class' => 'form-control']])

            ->add('photo', FileType::class, [
                         'label' => 'Photos',
                         'mapped' => false,
                         'required' => false,
                         'multiple' => false,
            ])
            ->add('maladie', EntityType::class, [
                'class' => Maladie::class,
                'choice_label' => fn(Maladie $maladie) => $maladie->getName(),
                'multiple' => true,
                'required' => true,
                'attr' => ['required' => true, 'class' => 'form-control select2', 'id' => 'select23', 'style' => 'width:100%'],
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exercice::class,
        ]);
    }
}
