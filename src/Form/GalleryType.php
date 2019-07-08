<?php

namespace App\Form;

use App\Entity\Galery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class GalleryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('alt', TextType::class, [
                'label' => 'Nom de l\'image:'
            ])
            ->add('private', CheckboxType::class, [
                'help' => '*Par default, l\'image est publique',
                'label' => 'Image privée',
            ])
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'help' => '*Poids maximum autorisé: ' . Galery::MAX_SIZE,
                'label' => 'Image: ',
                'attr' => [
                    'placeholder' => 'Chosissez votre image: '
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Galery::class,
        ]);
    }
}
