<?php

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/registrate') {
    require_once './../Controller/User.php';
    $obj = new User();

    if ($method === "GET") {
        $obj->getRegistrate();
    } elseif ($method === "POST") {
        $obj->userRegistrate();
    } else {
        echo "$method is not supported for $uri";
    }

} elseif ($uri === '/login') {
    require_once './../Controller/User.php';
    $obj = new User();

    if ($method === "GET") {
        $obj->getLogin();
    } elseif ($method === "POST") {
        $obj->systemLogin();
    } else {
        echo "$method is not supported for $uri";
    }

} elseif ($uri === '/main') {
    require_once './../Controller/Main.php';
    $obj = new Main();

    if ($method === "GET") {
        $obj->userVerification();
    } else {
        echo "$method is not supported for $uri";
    }

} elseif ($uri === '/add-product') {
    require_once './../Controller/Product.php';
    $obj = new Product();

    if ($method === "GET") {
        $obj->getAddProduct();
    } elseif ($method === "POST") {
        $obj->addUsersProduct();
    } else {
        echo "$method is not supported for $uri";
    }

} else {
    require_once './../View/404.html';
}