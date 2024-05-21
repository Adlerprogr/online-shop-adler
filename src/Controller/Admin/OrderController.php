<?php

namespace Controller\Admin;

use Request\OrderRequest;
use Service\AuthenticationService;
use Service\OrderService;

class OrderController
{
    private OrderService $orderService;
    private AuthenticationService $authenticationService;

    public function __construct()
    {
        $this->orderService = new OrderService();
        $this->authenticationService = new AuthenticationService();
    }

    public function getOrder(): void
    {
        if (!$this->authenticationService->check()) {
            header("Location: /login");
        }

        require_once './../../View/order.php';
    }

    public function postOrder(OrderRequest $request): void
    {
        if (!$this->authenticationService->check()) {
            header("Location: /login");
        }

        $errors = $request->validate();

        if (empty($errors)) {
            $user = $this->authenticationService->getCurrentUser();
            $userId = $user->getId();

            $this->orderService->create($userId, $request->getBody()); // Можно ли так передовать UserId?
        }

        require_once './../../View/order.php';
    }
}