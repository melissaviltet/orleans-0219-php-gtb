<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de l\'évènement:'
            ])
            ->add('date', null, [
                'label' => 'Date:'
            ])
            ->add('place', TextType::class, [
                'label' => 'Lieu:'
            ])
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'help' => '*Poids maximum autorisé: ' . Event::MAX_SIZE,
                'label' => 'Image: ',
                'attr' => [
                    'placeholder' => 'Chosissez votre image: '
                ],
            ])
            ->add('urlEvent', UrlType::class, [
                'label' => 'Addresse de l\'évènement:',
                'attr' => [
                    'placeholder' => 'https://'
                ],
            ])
            ->add('isPrivate')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
