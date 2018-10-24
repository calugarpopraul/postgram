<?php
/**
 * Created by PhpStorm.
 * User: Paula
 * Date: 10/24/2018
 * Time: 9:03 AM
 */namespace App\Controller;
use App\Entity\User;
use App\Form\UserRegistrationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
//use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Component\HttpKernel\Tests\Controller;





class UserController extends Controller
{
    /**
     * @Route("/register",name="user_register")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder){
        //build the form
        $user = new User();
        $form = $this->createForm(UserRegistrationType::class, $user);
        //handle the submit on POST
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            //encode password
            $password = $passwordEncoder->encodePassword($user,$user->getPassword());
            $user->setPassword($password);
//            $encoder = $this->get('security.password_encoder');
//            $password = $encoder->encodePassword($user, $user->getPassword());
//            $user->setPassword($password);
            //Set their role
            $user->setRole('ROLE_USER');
            //save user
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('app_login');
        }
        return $this->render('blog/register.html.twig',[
            'form' => $form->createView()
        ]);
    }
}