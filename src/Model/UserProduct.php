<?php

namespace Model;

class UserProduct extends Model
{
    public function create(int $userId, int $productId, int $quantity)
    {
        $stmt = $this->pdo->prepare("INSERT INTO user_products (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'quantity' => $quantity]);
        $addProducts = $stmt->fetch();

        return $addProducts;
    }

    public function updateQuantity(int $userId, int $productId, int $quantity):void
    {
        $stmt = $this->pdo->prepare("UPDATE user_products SET quantity = (quantity + :quantity) WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'quantity' => $quantity]);
    }

    public function checkProduct(int $userId, int $productId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user_products WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
        $check = $stmt->fetch();

        return $check;
    }

    public function productsUserCart($userId)
    {
        $stmt = $this->pdo->prepare("SELECT u.user_id, u.product_id, p.id, p.name, p.description, p.price, p.img_url, u.quantity FROM user_products u INNER JOIN products p ON u.product_id = p.id WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        $products = $stmt->fetchAll();

        return $products;
    }

//    public function checkQuantity(int $userId, int $productId)
//    {
//        $stmt = $this->pdo->prepare("SELECT * FROM user_products WHERE user_id = :user_id AND product_id = :product_id");
//        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
//        $check = $stmt->fetch();
//
//        return $check;
//    }

    public function minusProduct(int $userId, int $productId, int $quantity)
    {
        $stmt = $this->pdo->prepare("UPDATE user_products SET quantity = (quantity - :quantity) WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'quantity' => $quantity]);
    }

    public function deleteProduct(int $userId, int $productId)
    {
        $stmt = $this->pdo->prepare("DELETE FROM user_products WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
    }

    public function allProductsByUserId(int $user_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user_products WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $productsUser = $stmt->fetch();

        return $productsUser;
    }

}