<?php

function validateProduct(string $productId, string $quantity): array
{
    $errors = [];

    if (empty(productSearchById($productId))) {
        $errors['product_id'] = 'There is no such product';
    } elseif ($quantity <= 0) {
        $errors['quantity'] = 'The number must be greater than 0';
    }
    return $errors;
}

function productSearchById(int $id):array
{
    $pdo = new PDO("pgsql:host=db; port=5432; dbname=laravel", "root", "root");

    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $result = $stmt->fetch();

    return $result;
}

function addProduct(array $arr)
{
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: /login");
    }

    $userId = $_SESSION['user_id'];
    $productId = $arr['product_id'];
    $quantity = $arr['quantity'];

    $errors = validateProduct($productId, $quantity);

    if (empty($errors)) {
        $pdo = new PDO("pgsql:host=db; port=5432; dbname=laravel", "root", "root");

        $stmt = $pdo->prepare("INSERT INTO user_products (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'quantity' => $quantity]);

        header("Location: /add-product");
    } else {
        require_once 'add-product.php';
    }
}

addProduct($_POST);