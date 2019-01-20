<?php
/**
 * Created by PhpStorm.
 * user: raul
 * Date: 10/16/18
 * Time: 3:13 PM
 */

namespace App\Controller;


use App\Entity\User;
use App\Repository\MicroPostRepository;
use App\Repository\UserRepository;
use App\Service\Greeting;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig_Environment;


/**
 * @Route("/")
 */
class BlogController extends AbstractController
{
    /**
     * @var Twig_Environment
     */
    private $twig;
    /**
     * @var SessionInterface
     */
    private $session;
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var MicroPostRepository
     */
    private $microPostRepository;

    public function __construct(
        \Twig_Environment $twig,
        SessionInterface $session,
        RouterInterface $router)
    {
        $this->twig = $twig;
        $this->session = $session;
        $this->router = $router;
    }


    /**
     * @Route("/", name="blog_index")
     */
    public function index()
    {
        $html = $this->twig->render('blog/index.html.twig',
            [
                'posts' => $this->session->get('posts')
            ]);

        return new Response($html);
    }


    /**
     * @Route("/homepage", name="blog_homepage")
     */
    public function homepage()
    {
        return new Response(
            $this->twig->render('blog/homepage.html.twig')
        );
    }

    /**
     * @Route("/add", name="blog_add")
     */
    public function add()
    {
        $posts = $this->session->get('posts');
        $posts[uniqid()] = [
            'title' => 'A random title '.rand(1,500),
            'text' => 'Some random text nr '.rand(1,500),
            'date' => new \DateTime(),
        ];

        $this->session->set('posts', $posts);

        return new RedirectResponse($this->router->generate('blog_index'));
    }

    /**
     * @Route("/show/{id}", name="blog_show")
     */
    public function show($id)
    {
        $posts = $this->session->get('posts');

        if(!$posts || !isset($posts[$id])){
            throw new NotFoundHttpException('Post not found');
        }

        return $this->render('blog/post.html.twig',[
            'id' => $id,
            'post' => $posts[$id],
        ]);
    }

}