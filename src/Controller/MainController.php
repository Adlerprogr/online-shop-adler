hello world 19.03.24

<?php

class MainController
{
    private Product $modelProduct;

    public function __construct()
    {
        $this->modelProduct = new Product();
    }

    public function pathToPage()
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
            echo 'Are no products';
        } else {
            require_once './../View/main.php';
        }
    }

    public function addProduct(array $arr)
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        }

        $user_id = $_SESSION['user_id'];
        $product_id = $arr['product_id'];
        $quantity = $arr['quantity'];

        $errors = $this->validateMain($product_id, $quantity);

        $check = $this->modelProduct->checkProduct($user_id, $product_id);

        if (!empty($this->modelProduct->getProduct())) {
            if (empty($errors)) {
                if (empty($check)) {
                    $this->modelProduct->create($user_id, $product_id, $quantity);
                } else {
                    $this->modelProduct->updateQuantity($user_id, $product_id, $quantity);
                }

                header("Location: /main");
            } else {
                echo 'Specify another quantity greater than 0';
            }
        } else {
            echo 'There are no products';
        }
    }

    private function validateMain($product_id, $quantity)
    {
        $errors = [];

        if ($quantity <= 0) {
            $errors['quantity'] = 'Specify another quantity greater than 0';
        }

        return $errors;
    }
}