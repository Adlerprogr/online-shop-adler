<?php

namespace Service;

use Repository\UserProductRepository;

class MainService
{
    private UserProductRepository $userProductRepository;

    public function __construct()
    {
        $this->userProductRepository = new UserProductRepository();
    }

    public function addProduct($userId, array $data): void
    {
//        $arr = $request->getBody();

        if (empty($errors)) {
//            $userId = $_SESSION['user_id'];
//            $productId = $arr['product_id'];
//            $quantity = $arr['quantity'];

            $check = $this->userProductRepository->checkProduct($userId, $data['product_id']);

            if (empty($check)) {
                $this->userProductRepository->create($userId, $data['product_id'], $data['quantity']);
            } else {
                $this->userProductRepository->updateQuantity($userId, $data['product_id'], $data['quantity']);
            }
        }
    }
}