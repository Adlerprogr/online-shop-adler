<?php

namespace Entity;

use Model\Product;
use Model\User;

class UserProductEntity
{
    private int $id;
    private UserEntity $userId;
    private ProductEntity $productId;
    private int $quantity;

    public function __construct(int $id, UserEntity $userId, ProductEntity $productId, int $quantity)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->productId = $productId;
        $this->quantity = $quantity;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): UserEntity
    {
        return $this->userId;
    }

    public function setUserId(UserEntity $userId): void
    {
        $this->userId = $userId;
    }

    public function getProductId(): ProductEntity
    {
        return $this->productId;
    }

    public function setProductId(ProductEntity $productId): void
    {
        $this->productId = $productId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }


}