<?php

namespace App\Service;


use App\Entity\Post;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class PostManager
{
    private $formFactory;
    private $entityManager;

    public function __construct(
        FormFactoryInterface $formFactory,
        EntityManagerInterface $entityManager
    )
    {
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
    }

    public function createPost(Request $request)
    {
        $post = new Post();
        return $this->editPost($request, $post);
    }

    public function editPost(Request $request, Post $post)
    {
        $form = $this->formFactory->create(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->save($post);
            return; //$this->redirectToRoute('post_index');
        }

        return [
            'post' => $post,
            'form' => $form->createView(),
        ];
    }

    private function save(Post $post)
    {
        if (!$post->getId()) {
            $this->entityManager->persist($post);
        }
        $this->entityManager->flush();
    }


}