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
                'attr' => ['id' => 'summernote']
            ])
            ->add('trailHome', TextareaType::class, [
                'attr' => ['id' => 'summernote']
            ])
            ->add('triathlonContent', TextareaType::class, [
                'attr' => ['id' => 'summernote']
            ])
            ->add('triathlonHome', TextareaType::class, [
                'attr' => ['id' => 'summernote']
            ])
            ->add('clubContent', TextareaType::class, [
                'attr' => ['id' => 'summernote']
            ])
            ->add('clubHome', TextareaType::class, [
                'attr' => ['id' => 'summernote']
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
