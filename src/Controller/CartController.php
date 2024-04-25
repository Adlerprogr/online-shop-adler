<?php

namespace Controller;

use Model\Product;
use Model\UserProduct;

class CartController
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
        require_once './../View/cart.php';
    }

    public function getCart():void
    {
        if (session_status() == PHP_SESSION_NONE) { // Проверяю была ли запудена сессия, если нет запускаю, если да то пропускаю
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

        $cartProducts = $this->modelUserProduct->productsUserCart($userId); // !!! object UserProduct

        if (empty($cartProducts)) {
            echo 'The basket is empty'; // Как использовать в cart.php if, else с foreach?
        } else {
            $sumQuantity = 0;
            $sumPrice = 0;

            foreach ($cartProducts as $cartProduct) {
                $sumQuantity += $cartProduct->getQuantity();
                $sumPrice += $cartProduct->getQuantity() * $cartProduct->getProductId()->getPrice();
            }
        }

        require_once './../View/cart.php';
    }

    public function addProductCart(array $arr):void // в main.php при отправке формы отправляется всегда количевство 1
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        }

        $userId = $_SESSION['user_id'];
        $productId = $arr['product_id'];
        $quantity = 1;

        $errors = $this->validateMain($productId, $quantity); // Как использовать в cart.php if, else с foreach? Пока валидационные ошибки не выводяться в cart.php

        $checkProduct = $this->modelUserProduct->checkProduct($userId, $productId); // !!! object UserProduct

        if (empty($errors)) {
            if (empty($checkProduct)) {
                $this->modelUserProduct->create($userId, $productId, $quantity);
            } else {
                $this->modelUserProduct->updateQuantity($userId, $productId, $quantity);
            }

            header("Location: /main");
        }
    }

    private function validateMain($productId, $quantity):array // волидация не активна, смотри выше!
    {
        $errors = [];

        if (isset($productId)) {
            $getProduct = $this->modelProduct->getProductById($productId); // !!! object Product

            if (empty($productId)) {
                $errors['product_id'] = 'The product id should not be empty';
            } elseif ($getProduct === null) {
                $errors['product_id'] = 'There is no such product';
            }
        } else {
            $errors['product_id'] = 'The product id must be filled';
        }

        if (isset($quantity)) {
            if (empty($quantity)) {
                $errors['quantity'] = 'The quantity should not be empty';
            } elseif ($quantity <= 0) {
                $errors['quantity'] = 'The number must be greater than 0';
            }
        } else {
            $errors['quantity'] = 'The quantity must be filled';
        }

        return $errors;
    }

    public function deleteProduct(array $arr):void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        }

        $userId = $_SESSION['user_id'];
        $productId = $arr['product_id'];
        $quantity = 1;

        $errors = $this->validateMain($productId, $quantity); // Как использовать в cart.php if, else с foreach? Пока валидационные ошибки не выводяться в cart.php

        $checkProduct = $this->modelUserProduct->checkProduct($userId, $productId); // !!! object UserProduct

        if (empty($errors)) {
            if (!empty($checkProduct)) {
                if ($checkProduct->getQuantity() === 1) {
                    $this->modelUserProduct->deleteProduct($userId, $productId);
                } else {
                    $this->modelUserProduct->minusProduct($userId, $productId, $quantity);
                }
            } // сделать else

            header("Location: /main");
        }
    }
}