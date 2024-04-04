<?php

class CartController
{
    private Product $modelProduct;
    private UserProduct $modelUserProduct;

    public function __construct()
    {
        $this->modelProduct = new Product();
        $this->modelUserProduct = new UserProduct();
    }

    public function pathToPage()
    {
        require_once './../View/cart.php';
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
        $userId = $_SESSION['user_id'];

        $cartUser = $this->modelUserProduct->productsUserCart($userId);
        $sumProducts = $this->modelUserProduct->sumProducts($userId); // сумма продуктов

        if (empty($cartUser)) {
            echo 'The basket is empty';
        } else {
            require_once './../View/cart.php';
        }

/*
        $productsUser = $this->modelProduct->allProductsByUserId($user_id);
        $products = $this->modelProduct->getProduct();

        foreach ($productsUser as $key => $productUser) {
            $productbasket = [];
            foreach ($products as $jey => $product) {
                if ($product['id'] === $productUser['product_id']) {
                    $productbasket['name'] = $product['name'];
                    $productbasket['description'] = $product['description'];
                    $productbasket['price'] = $product['price'];
                    $productbasket['img_url'] = $product['img_url'];
                    $productbasket['quantity'] = $productUser['quantity'];
                }
            }
        }
        $basket = [$productbasket];

        require_once './../View/cart.php';
*/
    }
}