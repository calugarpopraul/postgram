<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 8/24/18
 * Time: 4:36 PM
 */

namespace App\Controller;

use App\Entity\User;
use App\Event\UserRegisterEvent;
use App\Form\UserRegistrationType;
use App\Form\UserType;
use App\Security\TokenGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends Controller
{

    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @Route("/register", name="user_register")
     */
    public function register(UserPasswordEncoderInterface $passwordEncoder,
                             Request $request,
                             EventDispatcherInterface $eventDispatcher,
                             TokenGenerator $tokenGenerator)
    {
        $user = new User();
        $form = $this->createForm(UserRegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword(
                $user,
                $user->getPlainPassword());
            $user->setPassword($password);
            $user->setConfirmationToken($tokenGenerator->getRandomSecureToken(30));

            $user->setRoles(['ROLE_USER']);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $userRegisterEvent = new UserRegisterEvent($user);

            $eventDispatcher->dispatch(UserRegisterEvent::NAME, $userRegisterEvent);

            return new RedirectResponse(
                $this->router->generate('micro_post_index')
            );

        }

        return $this->render(
            'blog/register.html.twig', [
            'form' => $form->createView()
        ]);

    }
}