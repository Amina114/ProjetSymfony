<?php

namespace App\Form;

use App\Entity\Student;
use App\Entity\Classroom;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('enabled')
            ->add('Classrooms', EntityType::class, [
                'class' => Classroom::class,
                'choice_label' => 'Name',
                'multiple' => false,
                'expanded'=> false
             ])
            ->add('Ajouter', SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
