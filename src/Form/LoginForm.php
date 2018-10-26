<?php
/**
 * Created by PhpStorm.
 * User: ciurb
 * Date: 24.10.2018
 * Time: 19:52
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginForm extends AbstractType
{ public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
        ->add('email',  EmailType::class,
            ['label' => false,
                'attr' => [
                    'id' => 'key',
                    'placeholder' => '  E-mail'
                ],
            ])
        ->add('password',PasswordType::class)

;
}

}