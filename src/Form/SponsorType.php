<?php

namespace App\Form;

use App\Entity\Sponsor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class SponsorType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Partenaire: ',
                'attr' => [
                    'placeholder' => 'Intersport ',
                ]
            ])
            ->add('imageFile', VichImageType::class, [
                'help' => '*Poids maximum autorisé: ' . Sponsor::MAX_SIZE,
                'label' => 'Logo: ',
                'attr' => [
                    'placeholder' => 'Chosissez votre image: '
                ]
            ])
            ->add('site', UrlType::class, [
                'label' => 'Site web: ',
                'attr' => [
                    'placeholder' => 'https:// ',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sponsor::class,
        ]);
    }
}
