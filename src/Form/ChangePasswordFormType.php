<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Saisissez votre email',
                ],
                'constraints' => [new NotBlank(['message'=>'Veuillez compléter ce champs'])]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne sont pas identiques',
                'options' => ['attr' => ['class' => 'mot de passe']],
                'required' =>true,
                'first_options' => ['label' => false, 'attr' => [
                    'placeholder' => 'Nouveau mot de passe',
                ],],
                'second_options' => ['label' => false,'attr' => [
                    'placeholder' => 'Confirmez votre nouveau mot de passe',
                ],]
            ]);
    }
}
