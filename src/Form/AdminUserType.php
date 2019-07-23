<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AdminUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $statusesRoles = User::ROLES;
        foreach ($statusesRoles as $status => $role) {
            $statuses[$status] = $status;
        }

        $builder
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('address', TextType::class)
            ->add('telephone', TextType::class)
            ->add('email', EmailType::class)
            ->add('status', ChoiceType::class, [
                'placeholder' => 'choisissez un rôle',
                'choices' => $statuses,
            ])
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_link' => false,
                'delete_label' => false,
                'label_attr' => [
                    'class' => 'pt-0'
                ],
                'help' => '*Poids maximum autorisé: ' . User::MAX_SIZE,
                'label' => 'Image du membre',
                'attr' => [
                    'placeholder' => 'Chosissez une image: '
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
