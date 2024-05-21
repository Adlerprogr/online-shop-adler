<?php

namespace Service;

use Repository\UserProductRepository;

class CartService
{
    private UserProductRepository $userProductRepository;

    public function __construct()
    {
        $this->userProductRepository = new UserProductRepository();
    }

    public function addProduct($userId, array $data): void
    {
        $checkProduct = $this->userProductRepository->checkProduct($userId, $data['product_id']);

        if (empty($checkProduct)) {
            $this->userProductRepository->create($userId, $data['product_id'], $data['quantity']);
        } else {
            $this->userProductRepository->updateQuantity($userId, $data['product_id'], $data['quantity']);
        }
    }

    public function getTotalPrice(array $cartProducts)
    {
        if (!empty($cartProducts)) {
            $sumQuantity = 0;
            $sumPrice = 0;

            foreach ($cartProducts as $cartProduct) {
                $sumQuantity += $cartProduct->getQuantity();
                $sumPrice += $cartProduct->getQuantity() * $cartProduct->getProductId()->getPrice();
            }

            $totalPrice = ['sum_quantity' => $sumQuantity, 'sum_price' => $sumPrice];

            return $totalPrice;
        } else {
            echo 'The basket is empty'; // Как использовать в cart.php if, else с foreach?
        }
    }

    public function deleteProduct(int $userId, array $data): void
    {
        $checkProduct = $this->userProductRepository->checkProduct($userId, $data['product_id']); // !!! object UserProductRepository

        if (!empty($checkProduct)) {
            if ($checkProduct->getQuantity() === 1) {
                $this->userProductRepository->deleteProduct($userId, $data['product_id']);
            } else {
                $this->userProductRepository->minusProduct($userId, $data['product_id'], $data['quantity']);
            }
        } // сделать else
    }
}