<?php

namespace Controller;

use Model\Product;
use Model\User;
use Model\UserProduct;

class UserProductController
{
    private Product $modelProduct;
    private User $modelUser;
    private UserProduct $modelUserProduct;

    public function __construct()
    {
        $this->modelProduct = new Product();
        $this->modelUser = new User();
        $this->modelUserProduct = new UserProduct();

    }

    public function getProducts():void
    {
        require_once './../View/add_product.php';
    }

    public function postAddProduct(array $arr):void
    {
        $errors = $this->validateUserProduct($arr);

        if (empty($errors)) {
            session_start();
            if (!isset($_SESSION['user_id'])) {
                header("Location: /login");
            }

            $userId = $_SESSION['user_id'];
            $productId = $arr['product_id'];
            $quantity = $arr['quantity'];

            $check = $this->modelUserProduct->checkProduct($userId, $productId);

            if (empty($check)) {
                $this->modelUserProduct->create($userId, $productId, $quantity);
            } else {
                $this->modelUserProduct->updateQuantity($userId, $productId, $quantity);
            }
        }

        require_once './../View/add_product.php';
    }

    private function validateUserProduct(array $arr): array
    {
        $errors = [];

        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];

            $getUser = $this->modelUser->getUserById($userId);

            if (empty($userId)) {
                $errors['user_id'] = 'The user id should not be empty';
            } elseif ($getUser === false) {
                $errors['user_id'] = 'Such a user is not registered';
            }
        } else {
            $errors['user_id'] = 'User id must be filled';
        }

        if (isset($arr['product_id'])) {
            $productId = $arr['product_id'];

            $getProduct = $this->modelProduct->getProductById($productId);

            if (empty($productId)) {
                $errors['product_id'] = 'The product id should not be empty';
            } elseif ($getProduct === false) {
                $errors['product_id'] = 'There is no such product';
            }
        } else {
            $errors['product_id'] = 'The product id must be filled';
        }

        if (isset($arr['quantity'])) {
            $quantity = $arr['quantity'];

            if (empty($quantity)) {
                $errors['quantity'] = 'The quantity should not be empty';
            } elseif ($quantity <= 0) {
                $errors['quantity'] = 'The number must be greater than 0';
            }
        } else {
            $errors['quantity'] = 'The quantity must be filled';
        }

        return $errors;
    }

    public function addingProducts():void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            if (!isset($_SESSION['user_id'])) {
                header("Location: /login");
            }
        } else {
            if (!isset($_SESSION['user_id'])) {
                header("Location: /login");
            }
        }

        $checkProducts = $this->modelProduct->getProducts();

        if (empty($checkProducts)) {
            echo 'Are no checkProducts';
        }

        require_once './../View/add_product.php';
    }
}