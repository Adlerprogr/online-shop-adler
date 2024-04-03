<?php

class UserProductProduct extends Model
{
    public function productsUserCart($userId)
    {
        $stmt = $this->pdo->prepare("SELECT u.user_id, u.product_id, p.id, p.name, p.description, p.price, p.img_url, u.quantity FROM user_products u INNER JOIN products p ON u.product_id = p.id WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        $products = $stmt->fetchAll();

        return $products;
    }

// доделать сумму продуктов, пока получаю сумму одного продукта
    public function sumProducts($userId)
    {
        $stmt = $this->pdo->prepare("SELECT u.user_id, u.product_id, p.id, SUM(u.quantity * p.price) AS sum_qp FROM user_products u INNER JOIN products p  ON u.product_id = p.id WHERE user_id = :user_id GROUP BY u.user_id, u.product_id, p.id");
        $stmt->execute(['user_id' => $userId]);
        $sum = $stmt->fetch();

        return $sum;
    }
}