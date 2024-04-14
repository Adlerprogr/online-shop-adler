<?php

namespace Core;

use Controller\CartController;
use Controller\MainController;
use Controller\UserController;
use Controller\UserProductController;

class App
{
    private array $routes = [
        '/registration' => [
            'GET' => [
                'class' => UserController::class,
                'method' => 'getRegistration'
            ],
            'POST' => [
                'class' => UserController::class,
                'method' => 'postRegistration'
            ],
        ],
        '/login' => [
            'GET' => [
                'class' => UserController::class,
                'method' => 'getLogin'
            ],
            'POST' => [
                'class' => UserController::class,
                'method' => 'postLogin'
            ],
        ],
        '/main' => [
            'GET' => [
                'class' => MainController::class,
                'method' => 'getMainPage'
            ],
        ],
        '/add-product' => [
            'GET' => [
                'class' => UserProductController::class,
                'method' => 'getProducts'
            ],
            'POST' => [
                'class' => UserProductController::class,
                'method' => 'postAddProduct'
            ],
        ],
        '/cart' => [
            'GET' => [
                'class' => CartController::class,
                'method' => 'getCart'
            ],
        ],
        '/delete-product' => [
            'POST' => [
                'class' => CartController::class,
                'method' => 'deleteProduct'
            ],
        ],
        '/plus-product' => [
            'POST' => [
                'class' => CartController::class,
                'method' => 'addProductCart'
            ],
        ]
    ];

    public function run():void
    {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        if (isset($this->routes[$uri])) {
            $routeMethod = $this->routes[$uri][$method];
            if (isset($routeMethod)) {
                $team = $routeMethod;
                $className = $team['class'];
                $function = $team['method'];
                $obj = new $className;
                $obj->$function();
            } else {
                echo "$method is not supported for $uri";
            }
        } else {
            require_once './../View/404.html';
        }
    }

//    public function handle()
//    {
//        $uri = $_SERVER['REQUEST_URI'];
//        $method = $_SERVER['REQUEST_METHOD'];
//
//        if ($uri === '/registrate') {
//            $obj = new UserController();
//
//            if ($method === "GET") {
//                $obj->getRegistration();
//            } elseif ($method === "POST") {
//                $obj->postRegistration($_POST);
//            } else {
//                echo "$method is not supported for $uri";
//            }
//        } elseif ($uri === '/login') {
//            $obj = new UserController();
//
//            if ($method === "GET") {
//                $obj->getLogin();
//            } elseif ($method === "POST") {
//                $obj->postLogin($_POST);
//            } else {
//                echo "$method is not supported for $uri";
//            }
//        } elseif ($uri === '/main') {
//            $obj = new MainController();
//
//            if ($method === "GET") {
//                $obj->getMainPage();
//            } else {
//                echo "$method is not supported for $uri";
//            }
//        } elseif ($uri === '/add-product') {
//            $obj = new UserProductController();
//
//            if ($method === "GET") {
//                $obj->getProducts();
//            } elseif ($method === "POST") {
//                $obj->postAddProduct($_POST);
//            } else {
//                echo "$method is not supported for $uri";
//            }
//        } elseif ($uri === '/cart') {
//            $obj = new CartController();
//
//            if ($method === "GET") {
//                $obj->getCart();
//                /* $obj->allProductsByUserId(); */
//            } else {
//                echo "$method is not supported for $uri";
//            }
//        } elseif ($uri === '/delete-product') {
//            $obj = new CartController();
//
//            if ($method === "POST") {
//                $obj->deleteProduct($_POST);
//            } else {
//                echo "$method is not supported for $uri";
//            }
//        } elseif ($uri === '/plus-product') {
//            $obj = new CartController();
//
//            if ($method === "POST") {
//                $obj->addProductCart($_POST);
//            } else {
//                echo "$method is not supported for $uri";
//            }
//        } else {
//            require_once './../View/404.html';
//        }
//    }
}