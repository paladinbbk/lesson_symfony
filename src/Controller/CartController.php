<?php

namespace App\Controller;

use App\Entity\Post;
use App\Service\CartManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CartController extends Controller
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index()
    {
        $cm = $this->get(CartManager::class);
        return $this->render('cart/index.html.twig', ['cart' => $cm->getCart()]);
    }

    /**
     * @Route("/add-to-cart/{product}", name="add_to_cart")
     */
    public function add(Post $product, Request $request)
    {
        $cm = $this->get(CartManager::class);

        $cm->add($product, $request->get('quantity'));

        return $this->redirectToRoute('cart');
    }
}
