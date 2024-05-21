<?php

namespace Service;

use Repository\OrderProductRepository;
use Repository\OrderRepository;
use Repository\UserProductRepository;

class OrderService
{
    private OrderRepository $orderRepository;
    private OrderProductRepository $orderProductRepository;
    private UserProductRepository $userProductRepository;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
        $this->orderProductRepository = new OrderProductRepository();
        $this->userProductRepository = new UserProductRepository();
    }

    public function create(int $userId, array $date): void
    {
        $this->orderRepository->createOrder($date['email'], $date['phone'], $date['name'], $date['address'], $date['city'], $date['postal_code'], $date['country']);

        $orderId = $this->orderRepository->getOrderId();

        $this->orderProductRepository->createOrderProduct($userId, $orderId);
        $this->userProductRepository->allDeleteProduct($userId);
    }
}