<?php

namespace Controller;

use Repository\UserProductRepository;
use Request\CartRequest;
use Service\AuthenticationService;
use Service\CartService;

class CartController
{
    private UserProductRepository $userProductRepository;
    private AuthenticationService  $authenticationService;
    private CartService $cartService;

    public function __construct()
    {
        $this->userProductRepository = new UserProductRepository();
        $this->authenticationService = new AuthenticationService();
        $this->cartService = new CartService();
    }

    public function pathToPage(): void
    {
        require_once './../View/cart.php';
    }

    public function getCart(): void
    {
        if (!$this->authenticationService->check()) {
            header("Location: /login");
        }

        $user = $this->authenticationService->getCurrentUser();
        $userId = $user->getId();

        $cartProducts = $this->userProductRepository->productsUserCart($userId); // !!! object UserProductRepository

        if (empty($cartProducts)) {
            $notification = 'Cart empty';
        }

        $totalQuantityPrice = $this->cartService->getTotalPrice($cartProducts);

        require_once './../View/cart.php';
    }

    public function addProduct(CartRequest $request): void // в main.php при отправке формы отправляется всегда количевство 1
    {
        if (!$this->authenticationService->check()) {
            header("Location: /login");
        }

        $errors = $request->validate(); // Как использовать в cart.php if, else с foreach? Пока валидационные ошибки не выводяться в cart.php

        if (empty($errors)) {
            $user = $this->authenticationService->getCurrentUser();
            $userId = $user->getId();

            $this->cartService->addProduct($userId, $request->getBody());

            header("Location: /main");
        }
    }

    public function deleteProduct(CartRequest $request): void
    {
        if (!$this->authenticationService->check()) {
            header("Location: /login");
        }

        $errors = $request->validate(); // Как использовать в cart.php if, else с foreach? Пока валидационные ошибки не выводяться в cart.php

        if (empty($errors)) {
            $user = $this->authenticationService->getCurrentUser();
            $userId = $user->getId();

            $this->cartService->deleteProduct($userId, $request->getBody());

            header("Location: /main");
        }
    }
}