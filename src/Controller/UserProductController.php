<?php

namespace Controller;

use Request\UserProductRequest;
use Service\AuthenticationService;
use Service\CartService;

class UserProductController
{
    private AuthenticationService  $authenticationService;
    private CartService  $cartService;

    public function __construct()
    {
        $this->authenticationService = new AuthenticationService();
        $this->cartService = new CartService();

    }

    public function getProducts(): void
    {
        require_once './../View/add_product.php';
    }

    public function postAddProduct(UserProductRequest $request): void
    {
        if (!$this->authenticationService->check()) {
            header("Location: /login");
        }

        $errors = $request->validate();

        if (empty($errors)) {
            $user = $this->authenticationService->getCurrentUser();
            $userId = $user->getId();

            $this->cartService->addProduct($userId, $request->getBody());
        }

        require_once './../View/add_product.php';
    }
}