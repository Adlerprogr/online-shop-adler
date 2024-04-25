<?php

namespace Repository;

class OrderProductRepository extends Repository
{
    public function createOrderProduct(int $userId, int $orderId): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO order_product (user_id, product_id, quantity, order_id) 
            SELECT user_id, product_id, quantity, :order_id 
            FROM user_product 
            WHERE user_id = :user_id
        ");
        $stmt->execute(['user_id' => $userId, 'order_id' => $orderId]);
    }
}