<?php
/**
 * Created by PhpStorm.
 * User: raul
 * Date: 10/16/18
 * Time: 3:13 PM
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Twig_Environment;

/**
 * @Route("/blog")
 */
class BlogController extends AbstractController
{
    private $twig;

    private $session;

    private $router;

    public function __construct(
        Twig_Environment $twig,
        SessionInterface $session,
        RouterInterface $router
    )
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
        return $this->render('base.html.twig',[

        ]);
    }
}