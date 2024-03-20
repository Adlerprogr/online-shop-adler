<?php

class App
{
    public function handle()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        if ($uri === '/registrate') {
            $obj = new UserController();

            if ($method === "GET") {
                $obj->registForm();
            } elseif ($method === "POST") {
                $obj->registrate($_POST);
            } else {
                echo "$method is not supported for $uri";
            }
        } elseif ($uri === '/login') {
            $obj = new UserController();

            if ($method === "GET") {
                $obj->loginForm();
            } elseif ($method === "POST") {
                $obj->systemLogin($_POST);
            } else {
                echo "$method is not supported for $uri";
            }
        } elseif ($uri === '/main') {
            $obj = new MainController();

            if ($method === "GET") {
                $obj->userVerification();
            } elseif ($method === "POST") {
                $obj->addProduct($_POST);
            } else {
                echo "$method is not supported for $uri";
            }
        } elseif ($uri === '/add-product') {
            $obj = new UserProductController();

            if ($method === "GET") {
                if ($obj->userByVerification() === 'Are no products') {
                    echo 'Are no products';
                } else {
                    $obj->pathToAdding();
                }
            } elseif ($method === "POST") {
                $obj->addUsersProduct($_POST);
            } else {
                echo "$method is not supported for $uri";
            }
        } elseif ($uri === '/basket') {
            $obj = new BasketController();

            if ($method === "GET") {
                $obj->getCart();
            } else {
                echo "$method is not supported for $uri";
            }
        } else {
            require_once './../View/404.html';
        }
    }
}