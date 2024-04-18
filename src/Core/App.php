<?php

namespace Core;

use Controller\CartController;
use Controller\MainController;
use Controller\OrderController;
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
        ],
        '/order' => [
            'GET' => [
                'class' => OrderController::class,
                'method' => 'getOrder'
            ],
            'POST' => [
                'class' => OrderController::class,
                'method' => 'postOrder'
            ],
        ]
    ];

    public function run():void
    {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        if (isset($this->routes[$uri])) {
            $routeMethod = $this->routes[$uri];
            if (isset($routeMethod[$method])) {
                $team = $routeMethod[$method];
                $className = $team['class'];
                $function = $team['method'];
                $obj = new $className;
                if ($team === 'GET') {
                    $obj->$function();
                } else {
                    $obj->$function($_POST);
                }
            } else {
                echo "$method is not supported for $uri";
            }
        } else {
            require_once './../View/404.html';
        }
    }
}