<?php

namespace App\Form;

use App\Entity\Association;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Association1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('trailContent', TextareaType::class, [
                'label' => 'Page du trail',
                'label_attr' => ['class' => 'col-12'],
                'attr' => ['class' => 'summernote']
            ])
            ->add('trailHome', TextareaType::class, [
                'label' => 'Résumé du Trail',
                'label_attr' => ['class' => 'col-12'],
                'attr' => [
                    'class' => 'summernote',
                    'row' => '6'
                ]
            ])
            ->add('triathlonContent', TextareaType::class, [
                'label' => 'Page du triathlon',
                'label_attr' => ['class' => 'col-12'],
                'attr' => [
                    'class' => 'summernote',
                    'row' => '6'
                ]
            ])
            ->add('triathlonHome', TextareaType::class, [
                'label' => 'Résumé du Triathlon',
                'label_attr' => ['class' => 'col-12'],
                'attr' => ['class' => 'summernote']
            ])
            ->add('clubContent', TextareaType::class, [
                'label' => 'Page du club',
                'label_attr' => ['class' => 'col-12'],
                'attr' => ['class' => 'summernote']
            ])
            ->add('clubHome', TextareaType::class, [
                'label' => 'Résumé du Club',
                'label_attr' => ['class' => 'col-12'],
                'attr' => ['class' => 'summernote']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Association::class,
        ]);
    }
}
