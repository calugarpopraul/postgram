<?php
/**
 * Created by PhpStorm.
 * User: raul
 * Date: 10/23/18
 * Time: 10:25 PM
 */

namespace App\Controller;

use App\Form\LoginForm;
use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    /**
     * @var \Twig_Environment
     */
    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/login", name="security_login")
     */
    public function login(Request $request,AuthenticationUtils $authenticationUtils)
    {

        $form = $this->createForm(LoginType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            return new RedirectResponse(
                $this->redirectToRoute('micro_post_index')
            );
        }


        return new Response($this->twig->render(
            'security/login.html.twig',
            [
                'form' => $form->createView(),
                'last_username' => $authenticationUtils->getLastUsername(),
                'error' => $authenticationUtils->getLastAuthenticationError()
            ]
           )
        );

    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout()
    {

    }

}