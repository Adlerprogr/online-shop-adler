<?php

require_once './../Controller/UserController.php';
require_once './../Controller/MainController.php';
require_once './../Controller/UserProductController.php';

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/registrate') {
//    require_once './../Controller/UserController.php';
    $obj = new UserController();

    if ($method === "GET") {
        $obj->registForm();
    } elseif ($method === "POST") {
        $obj->registrate($_POST);
    } else {
        echo "$method is not supported for $uri";
    }

} elseif ($uri === '/login') {
//    require_once './../Controller/UserController.php';
    $obj = new UserController();

    if ($method === "GET") {
        $obj->loginForm();
    } elseif ($method === "POST") {
        $obj->systemLogin($_POST);
    } else {
        echo "$method is not supported for $uri";
    }

} elseif ($uri === '/main') {
//    require_once './../Controller/MainController.php';
    $obj = new MainController();

    if ($method === "GET") {
        $obj->userVerification();
    } else {
        echo "$method is not supported for $uri";
    }

} elseif ($uri === '/add-product') {
//    require_once './../Controller/UserProductController.php';
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
} else {
    require_once './../View/404.html';
}