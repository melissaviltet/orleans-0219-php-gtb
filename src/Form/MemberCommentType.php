<?php

namespace App\Form;

use App\Entity\Comment;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MemberCommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $comment = new Comment();

        $builder
            ->add('message', TextType::class, [
                'label' => ' ',
                'attr' => [
                    'placeholder' => 'Votre message ici',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
