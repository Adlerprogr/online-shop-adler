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

        $productsUser = $this->modelProduct->allProductsByUserId($user_id);
        $products = $this->modelProduct->getProduct();

        foreach ($productsUser as $productUser) {
            $productbasket = [];
            foreach ($products as $product) {
                if ($product['id'] === $productUser['product_id']) {
                    $productbasket['name'] = $product['name'];
                    $productbasket['description'] = $product['description'];
                    $productbasket['price'] = $product['price'];
                    $productbasket['img_url'] = $product['img_url'];
                    $productbasket['quantity'] = $productUser['quantity'];
                }
            }
            $basket = [$productbasket];
        }

        require_once './../View/basket.php';
    }
}