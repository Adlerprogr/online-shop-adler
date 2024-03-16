<?php

class Product
{
    public function create(int $user_id, int $product_id, int $quantity)
    {
        $pdo = new PDO("pgsql:host=db; port=5432; dbname=laravel", "root", "root");

        $stmt = $pdo->prepare("INSERT INTO user_products (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
        $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id, 'quantity' => $quantity]);
        $result = $stmt->fetch();

        return $result;
    }

    public function getUserById(int $user_id)
    {
        $pdo = new PDO("pgsql:host=db; port=5432; dbname=laravel", "root", "root");

        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $user_id]);
        $getUser = $stmt->fetch();

        return $getUser;
    }

    public function getProductById(int $product_id)
    {
        $pdo = new PDO("pgsql:host=db; port=5432; dbname=laravel", "root", "root");

        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $product_id]);
        $getProduct = $stmt->fetch();

        return $getProduct;
    }

    public function updateQuantity(int $user_id, int $product_id, int $quantity):void
    {
        $pdo = new PDO("pgsql:host=db; port=5432; dbname=laravel", "root", "root");

        $stmt = $pdo->prepare("UPDATE user_products SET quantity = (quantity + :quantity) WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id, 'quantity' => $quantity]);
    }

    public function checkProduct(int $user_id, int $product_id)
    {
        $pdo = new PDO("pgsql:host=db; port=5432; dbname=laravel", "root", "root");

        $stmt = $pdo->prepare("SELECT * FROM user_products WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id]);
        $resultCheck = $stmt->fetch();

        return $resultCheck;
    }
}