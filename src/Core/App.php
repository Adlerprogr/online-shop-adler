<?php

namespace Core;

use Controller\CartController;
use Controller\MainController;
use Controller\OrderController;
use Controller\UserController;
use Controller\UserProductController;
use Request\CartRequest;
use Request\OrderRequest;
use Request\RegistrationRequest;
use Request\LoginRequest;
use Request\UserProductRequest;
use Request\Request;

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
                'method' => 'postRegistration',
                'request' => RegistrationRequest::class
            ],
        ],
        '/login' => [
            'GET' => [
                'class' => UserController::class,
                'method' => 'getLogin'
            ],
            'POST' => [
                'class' => UserController::class,
                'method' => 'postLogin',
                'request' => LoginRequest::class
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
                'method' => 'postAddProduct',
                'request' => UserProductRequest::class
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
                'method' => 'deleteProduct',
                'request' => CartRequest::class
            ],
        ],
        '/plus-product' => [
            'POST' => [
                'class' => CartController::class,
                'method' => 'addProductCart',
                'request' => CartRequest::class
            ],
        ],
        '/order' => [
            'GET' => [
                'class' => OrderController::class,
                'method' => 'getOrder'
            ],
            'POST' => [
                'class' => OrderController::class,
                'method' => 'postOrder',
                'request' => OrderRequest::class
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
                $handler = $routeMethod[$method];

                $class = $handler['class'];
                $functionMethod = $handler['method'];

                if (isset($handler['request'])) {
                    $requestClass = $handler['request'];
                    $request = new $requestClass($method, $uri, headers_list(), $_POST);
                } else {
                    $request = new Request($method, $uri, headers_list(), $_POST);
                }

                $obj = new $class;
                $obj->$functionMethod($request);
            } else {
                echo "$method is not supported for $uri";
            }
        } else {
            require_once './../View/404.html';
        }
    }
}