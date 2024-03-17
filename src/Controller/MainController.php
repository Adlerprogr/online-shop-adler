<?php

require_once './../Model/Product.php';

class MainController
{
    private Product $modelProduct;

    public function __construct()
    {
        $this->modelProduct = new Product();
    }

    public function pathToPage():void
    {
        require_once './../View/main.php';
    }

    public function userVerification()
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

        $products = $this->modelProduct->getProduct();

        if (empty($products)) {
            return 'Are no products';
        } else {
            require_once './../View/main.php';
        }
    }
}