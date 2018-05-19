<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Post;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class MainController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/blog", name="blog")
     */
    public function blog(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();

        return $this->render('main/blog.html.twig', compact('categories'));
    }

    /**
     * @Route("/article/{articleId}", name="article")
     */
    public function article($articleId)
    {
        $post = $this->getDoctrine()->getRepository(Post::class)->find($articleId);

        return $this->render('main/article.html.twig', [
            'post' => $post,
        ]);
    }
}
