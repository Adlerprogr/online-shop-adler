<?php

namespace Controller;

use Model\Product;
use Model\UserProduct;

class MainController
{
    private Product $modelProduct;
    private UserProduct $modelUserProduct;

    public function __construct()
    {
        $this->modelProduct = new Product();
        $this->modelUserProduct = new UserProduct();
    }

    public function pathToPage():void
    {
        require_once './../View/main.php';
    }

    public function getMainPage():void
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

        $products = $this->modelProduct->getProducts();

        if (isset($products)) {
            $allUsersProducts = $this->modelUserProduct->productsUserCart($userId);
            $sumQuantity = 0;

            foreach ($allUsersProducts as $cartProduct) {
                $sumQuantity += $cartProduct['quantity'];
            }
        } // сделать else

        require_once './../View/main.php';
    }
}