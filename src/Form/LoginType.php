<?php
/**
 * Created by PhpStorm.
 * user: raul
 * Date: 10/25/18
 * Time: 8:49 PM
 */

namespace App\Form;


use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('username', TextType::class,
            ['label' => false,
                'attr' => [
                    'id' => 'username',
                    'placeholder' => '  Username'
                ],
            ])
        ->add('password', PasswordType::class,
        [
            'label' => false,
            'attr' => [
                'id' => 'password',
                'placeholder' => 'Password'
            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}