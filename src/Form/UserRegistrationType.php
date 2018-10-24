<?php
/**
 * Created by PhpStorm.
 * User: Paula
 * Date: 10/24/2018
 * Time: 9:06 AM
 */

namespace App\Form;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;



class UserRegistrationType extends AbstractType
{    public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
        ->add('email', EmailType::class,
            ['label' => false,
                'attr' => [
                    'id' => 'key',
                    'placeholder' => '  E-mail'
                ],
            ])
        ->add('username', TextType::class,
            ['label' => false,
                'attr' => [
                    'id' => 'key',
                    'placeholder' => '  Username'
                ],
            ])
        ->add('plainPassword', RepeatedType::class
            ,array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => false,'attr' => [
                    'placeholder' => '  Password'
                ],),
                'second_options' => array('label' =>  false,'attr' => [
                    'placeholder' => ' Repeat password '
                ],),
            ))
    ;
}
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }

}