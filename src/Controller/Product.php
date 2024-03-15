<?php

class Product
{
    public function getAddProduct():void
    {
        require_once './../View/add_product.php';
    }

    public function addUsersProduct():void
    {
        $errors = $this->validateUserProduct($_POST);

        if (empty($errors)) {
            $pdo = new PDO("pgsql:host=db; port=5432; dbname=laravel", "root", "root");

            session_start();
            if (!isset($_SESSION['user_id'])) {
                header("Location: /login");
            }

            $user_id = $_SESSION['user_id'];
            $product_id = $_POST['product_id'];
            $quantity = $_POST['quantity'];

            $stmt = $pdo->prepare("INSERT INTO user_products (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
            $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id, 'quantity' => $quantity]);
            $result = $stmt->fetch();
        }

        require_once './../View/add_product.php';
    }

    private function validateUserProduct(array $arr): array
    {
        $errors = [];

        if (isset($arr['user_id'])) {
            $user_id = $arr['user_id'];

            $pdo = new PDO("pgsql:host=db; port=5432; dbname=laravel", "root", "root");

            $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->execute(['id' => $user_id]);
            $validateUsers = $stmt->fetch();

            if (empty($user_id)) {
                $errors['user_id'] = 'The user id should not be empty';
            } elseif ($validateUsers === false) {
                $errors['user_id'] = 'Such a user is not registered';
            }
        } else {
            $errors['user_id'] = 'User id must be filled';
        }

        if (isset($arr['product_id'])) {
            $product_id = $arr['product_id'];

            $pdo = new PDO("pgsql:host=db; port=5432; dbname=laravel", "root", "root");

            $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
            $stmt->execute(['id' => $product_id]);
            $validateProduct = $stmt->fetch();

            if (empty($product_id)) {
                $errors['product_id'] = 'The product id should not be empty';
            } elseif ($validateProduct === false) {
                $errors['product_id'] = 'There is no such product';
            }
        } else {
            $errors['product_id'] = 'The product id must be filled';
        }

        if (isset($arr['quantity'])) {
            $quantity = $arr['quantity'];

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
}