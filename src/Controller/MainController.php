<?php

class MainController
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
        require_once './../View/main.php';
    }

    public function mainPage()
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

        $products = $this->modelProduct->getProducts();

        if (empty($products)) {
            echo 'Are no products';
        } else {
            require_once './../View/main.php';
        }
    }

    public function addProductCart(array $arr)
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        }

        $userId = $_SESSION['user_id'];
        $productId = $arr['product_id'];
        $quantity = $arr['quantity'];

        $errors = $this->validateMain($productId, $quantity);

        $check = $this->modelUserProduct->checkProduct($userId, $productId);

        if (!empty($this->modelProduct->getProducts())) {
            if (empty($errors)) {
                if (empty($check)) {
                    $this->modelUserProduct->create($userId, $productId, $quantity);
                } else {
                    $this->modelUserProduct->updateQuantity($userId, $productId, $quantity);
                }

                header("Location: /main");
            } else {
                echo 'Specify another quantity greater than 0';
            }
        } else {
            echo 'There are no products';
        }
    }

    private function validateMain($productId, $quantity) // Нужно додбавить проверки и изменить название
    {
        $errors = [];

        if ($quantity <= 0) {
            $errors['quantity'] = 'Specify another quantity greater than 0';
        }

        return $errors;
    }
}