<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\Tag;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use App\Repository\TagRepository;
use App\Service\MyManager;
use App\Service\PostManager;
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
//        $obj = $this->get(PostManager::class);
//        dump($obj->toDo());
//        die;

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/blog", name="blog")
     */
    public function blog(CategoryRepository $categoryRepository, PostRepository $postRepository)
    {
        $categories = $categoryRepository->findAll();

        dump($postRepository->getPostsByCategory($categories[0]));

        die;
        return $this->render('main/blog.html.twig', compact('categories'));
    }

    /**
     * @Route("/article/{postSlug}", name="article")
     * @ParamConverter("post", options={"mapping": {"postSlug": "slug"}})
     */
    public function article(Post $post)
    {
        return $this->render('main/article.html.twig', [
            'post' => $post,
        ]);
    }

    /**
     * @Route("/tag/{tagTitle}", name="tag")
     * @ParamConverter("tag", options={"mapping": {"tagTitle": "title"}})
     */
    public function tag(Tag $tag)
    {
        return $this->render('main/tag.html.twig', compact('tag'));
    }

    public function tags(TagRepository $repository, $place = null)
    {
        $tags = $repository->findAll(); dump($place);
        return $this->render('main/partial/tags.html.twig',
            compact('tags')
        );
    }
}
