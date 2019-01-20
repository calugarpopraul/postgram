<?php
/**
 * Created by PhpStorm.
 * user: Paula
 * Date: 10/24/2018
 * Time: 9:06 AM
 */

namespace App\Form;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\IsTrue;


class UserRegistrationType extends AbstractType
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
            ->add('email', EmailType::class,
               ['label' => false,
                  'attr' => [
                      'id' => 'username',
                      'placeholder' => '  Email'
                  ],
            ])
            ->add('fullName', TextType::class,
                ['label' => false,
                    'attr' => [
                        'id' => 'username',
                        'placeholder' => '  Full name'
                    ],
                ])

            ->add('plainPassword', RepeatedType::class, [
                'type' =>PasswordType::class,
                'first_options' => ['label' => false,
                    'attr' => [
                        'id' => 'password',
                        'placeholder' => 'Password'
                    ]],
                'second_options' => ['label' => false,
                    'attr' => [
                        'id' => 'password',
                        'placeholder' => ' Repeat password'
                    ]]
            ]);
//            ->add('Sign up', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }

}