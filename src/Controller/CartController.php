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

        $allUsersProducts = $this->modelUserProduct->productsUserCart($userId);

        if (empty($allUsersProducts)) {
            echo 'The basket is empty'; // Как использовать в cart.php if, else с foreach?
        } else {
            $sumQuantity = 0;
            $sumPrice = 0;

            foreach ($allUsersProducts as $cartProduct) {
                $sumQuantity += $cartProduct['quantity'];
                $sumPrice += $cartProduct['quantity'] * $cartProduct['price'];
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

        $checkProduct = $this->modelUserProduct->checkProduct($userId, $productId);

        if (empty($errors)) {
            if (empty($checkProduct)) {
                $this->modelUserProduct->create($userId, $productId, $quantity);
            } else {
                $this->modelUserProduct->updateQuantity($userId, $productId, $quantity);
            }

            header("Location: /main");
        }
    }

    private function validateMain($productId, $quantity):array // волидация не активна, смотри выше + какие два типа указать функции?
    {
        $errors = [];

        if (isset($productId)) {
            $getProduct = $this->modelProduct->getProductById($productId);

            if (empty($productId)) {
                $errors['product_id'] = 'The product id should not be empty';
            } elseif ($getProduct === false) {
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

        $checkProduct = $this->modelUserProduct->checkProduct($userId, $productId);

        if (empty($errors)) {
            if (!empty($checkProduct)) {
                if ($checkProduct['quantity'] === 1) {
                    $this->modelUserProduct->deleteProduct($userId, $productId);
                } else {
                    $this->modelUserProduct->minusProduct($userId, $productId, $quantity);
                }
            } // сделать else

            header("Location: /main");
        }
    }
}