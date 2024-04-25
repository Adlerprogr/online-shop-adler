<?php

namespace Model;

use Entity\UserEntity;
use Entity\ProductEntity;
use Entity\UserProductEntity;

class UserProduct extends Model
{
    public function create(int $userId, int $productId, int $quantity): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO user_product (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'quantity' => $quantity]);
    }

    public function updateQuantity(int $userId, int $productId, int $quantity): void
    {
        $stmt = $this->pdo->prepare("UPDATE user_product SET quantity = (quantity + :quantity) WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'quantity' => $quantity]);
    }

    public function checkProduct(int $userId, int $productId): UserProductEntity|null
    {
        $stmt = $this->pdo->prepare("SELECT 
        up.id AS id, up.quantity,
        u.id AS user_id, u.first_name, u.last_name, u.email, u.password, u.repeat_password, 
        p.id AS product_id, p.name, p.description, p.price, p.img_url
        FROM user_product up
        INNER JOIN users u 
            ON u.id = up.user_id 
        INNER JOIN products p 
            ON p.id = up.product_id
        WHERE u.id = :user_id AND p.id = :product_id
        ");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);

        $check = $stmt->fetch();

        if (empty($check)) {
            return null;
        }

        return new UserProductEntity(
            $check['id'],
            new UserEntity($check['user_id'], $check['first_name'], $check['last_name'], $check['email'], $check['password'], $check['repeat_password']),
            new ProductEntity($check['product_id'], $check['name'], $check['description'], $check['price'], $check['img_url']),
            $check['quantity']
        );
    }

    public function productsUserCart($userId): array|null
    {
        $stmt = $this->pdo->prepare("SELECT 
        up.id AS id, up.quantity,
        u.id AS user_id, u.first_name, u.last_name, u.email, u.password, u.repeat_password, 
        p.id AS product_id, p.name, p.description, p.price, p.img_url
        FROM user_product up
        INNER JOIN users u 
            ON u.id = up.user_id 
        INNER JOIN products p 
            ON p.id = up.product_id
        WHERE u.id = :user_id
        ");
        $stmt->execute(['user_id' => $userId]);

        $products = $stmt->fetchAll();

        if (empty($products)) {
            return null;
        }

        $userProductArray = [];
        foreach ($products as $product) {
            $userProductArray[] = new UserProductEntity(
                $product['id'],
                new UserEntity($product['user_id'], $product['first_name'], $product['last_name'], $product['email'], $product['password'], $product['repeat_password']),
                new ProductEntity($product['product_id'], $product['name'], $product['description'], $product['price'], $product['img_url']),
                $product['quantity']
            );
        }

        return $userProductArray;
    }

//    public function checkQuantity(int $userId, int $productId)
//    {
//        $stmt = $this->pdo->prepare("SELECT * FROM user_products WHERE user_id = :user_id AND product_id = :product_id");
//        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
//        $check = $stmt->fetch();
//
//        return $check;
//    }

    public function minusProduct(int $userId, int $productId, int $quantity): void
    {
        $stmt = $this->pdo->prepare("UPDATE user_product SET quantity = (quantity - :quantity) WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'quantity' => $quantity]);
    }

    public function deleteProduct(int $userId, int $productId): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM user_product WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
    }

//    public function allProductsByUserId(int $user_id)
//    {
//        $stmt = $this->pdo->prepare("SELECT * FROM user_product WHERE user_id = :user_id");
//        $stmt->execute(['user_id' => $user_id]);
//        $productsUser = $stmt->fetch();
//
//        return $productsUser;
//    }

    public function allDeleteProduct(int $userId): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM user_product WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
    }
}