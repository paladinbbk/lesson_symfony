<?php

namespace App\Service;

use App\Entity\Post;
use App\Repository\PostRepository;

class CartManager
{
    const SESSION_CART_ID = 'cart';

    private $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function add(Post $product, int $quantity)
    {
        if ($_SESSION[self::SESSION_CART_ID] && isset($_SESSION[self::SESSION_CART_ID][$product->getId()])) {
            $_SESSION[self::SESSION_CART_ID][$product->getId()] += $quantity;
            return;
        }
        $_SESSION[self::SESSION_CART_ID][$product->getId()] = $quantity;

    }

    public function getCart() :array
    {
       $res = [];

       if (!isset($_SESSION[self::SESSION_CART_ID]) || empty($_SESSION[self::SESSION_CART_ID])) {
           return [];
       }

        foreach ($_SESSION[self::SESSION_CART_ID] as $productId => $quantity) {
            $position['quantity'] = $quantity;
            $position['product'] = $this->repository->find($productId);
            $res[] = $position;
        }

        return $res;
    }

//    public function getSession()
//    {
//        return isset($_SESSION[self::SESSION_CART_ID]) ? $_SESSION[self::SESSION_CART_ID] : null;
//    }
}