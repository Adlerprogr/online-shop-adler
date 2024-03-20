<?php

class BasketController
{
    private Product $modelProduct;

    public function __construct()
    {
        $this->modelProduct = new Product();
    }

    public function pathToPage()
    {
        require_once './../View/basket.php';
    }

    public function getCart()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            if (!isset($_SESSION['user_id'])) {
                header("Location: /login");
            }
        } else {
            if (!isset($_SESSION['user_id'])) {
                header("Location: /login");
            }
        }

        $user_id = $_SESSION['user_id'];

        $products = $this->modelProduct->productBasket($user_id);

        if (empty($products)) {
            echo 'Are no products';
        } else {
            require_once './../View/basket.php';
        }
    }
}