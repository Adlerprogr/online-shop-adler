<?php

namespace Model;

use Entity\ProductEntity;

class Product extends Model
{
    public function getProducts(): array|null
    {
        $stmt = $this->pdo->query("SELECT * FROM products");
        $products = $stmt->fetchAll();

        if (empty($products)) {
            return null;
        }

        $productEntity = [];
        foreach ($products as $product) {
            $productEntity[] = new ProductEntity($product['id'], $product['name'], $product['description'], $product['price'], $product['img_url']);
        }

        return $productEntity;
    }

    public function getProductById(int $productId): ProductEntity|null
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $productId]);
        $getProduct = $stmt->fetch();

        if (empty($getProduct)) {
            return null;
        }

        return new ProductEntity($getProduct['id'], $getProduct['name'], $getProduct['description'], $getProduct['price'], $getProduct['img_url']);
    }
}