<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', TextType::class, ['attr' => ['placeholder' => 'Nom']])
            ->add('firstname', TextType::class, ['attr' => ['placeholder' => 'Prénom']])
            ->add('email', EmailType::class, ['attr' => ['placeholder' => 'E-mail']])
            ->add('subject', ChoiceType::class, ['placeholder' => 'choisissez un sujet', 'choices' => [
                'Trail' => 'Trail',
                'Evénement' => 'Evénement',
                'Entraînement' => 'Entraînement',
                'Autre' => 'Autre',
                'Triathlon' => 'Triathlon',
                'Natation' => 'Natation',
                'Cyclisme' => 'Cyclisme',
            ],
            ])
            ->add('message', TextareaType::class, ['attr' => ['placeholder' => 'Votre message']]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
