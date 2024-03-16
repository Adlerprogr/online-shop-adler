<?php

class MainController
{
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

        require_once './../Model/Product.php';
        $mainModel = new Product();
        $products = $mainModel->getProduct();

        if (empty($products)) {
            return 'Are no products';
        } else {
            require_once './../View/main.php';
        }
    }
}