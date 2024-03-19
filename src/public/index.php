<?php

//require_once './../Controller/UserController.php';
//require_once './../Controller/MainController.php';
//require_once './../Controller/UserProductController.php';

$autoloadController = function (string $className)
{
    $path = "./../Controller/$className.php";
    if (file_exists($path)) {
        require_once $path;

        return true;
    }

    return false;
};

$autoloadModel = function (string $className)
{
    $path = "./../Model/$className.php";
    if (file_exists($path)) {
        require_once $path;

        return true;
    }

    return false;
};

spl_autoload_register($autoloadController);
spl_autoload_register($autoloadModel);

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
} else {
    require_once './../View/404.html';
}