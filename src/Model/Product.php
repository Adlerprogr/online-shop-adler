<?php

class Product extends Model
{
    public function getProducts()
    {
        $stmt = $this->pdo->query("SELECT * FROM products");
        $products = $stmt->fetchAll();

        return $products;
    }

    public function getProductById(int $productId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $productId]);
        $getProduct = $stmt->fetch();

        return $getProduct;
    }
}