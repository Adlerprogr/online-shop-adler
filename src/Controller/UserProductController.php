<?php

require_once './../Model/Product.php';

class UserProductController
{
    private Product $modelProduct;

    public function __construct()
    {
        $this->modelProduct = new Product();
    }

    public function pathToAdding():void
    {
        require_once './../View/add_product.php';
    }

    public function addUsersProduct(array $arr):void
    {
        $errors = $this->validateUserProduct($arr);

        if (empty($errors)) {
            session_start();
            if (!isset($_SESSION['user_id'])) {
                header("Location: /login");
            }

            $user_id = $_SESSION['user_id'];
            $product_id = $_POST['product_id'];
            $quantity = $_POST['quantity'];

            $check = $this->modelProduct->checkProduct($user_id, $product_id);

            if (empty($check)) {
                $this->modelProduct->create($user_id, $product_id, $quantity);
            } else {
                $this->modelProduct->updateQuantity($user_id, $product_id, $quantity);
            }
        }

        require_once './../View/add_product.php';
    }

    private function validateUserProduct(array $arr): array
    {
        $errors = [];

        if (isset($arr['user_id'])) {
            $user_id = $arr['user_id'];

            $getUser = $this->modelProduct->getUserById($user_id);

            if (empty($user_id)) {
                $errors['user_id'] = 'The user id should not be empty';
            } elseif ($getUser === false) {
                $errors['user_id'] = 'Such a user is not registered';
            }
        } else {
            $errors['user_id'] = 'UserController id must be filled';
        }

        if (isset($arr['product_id'])) {
            $product_id = $arr['product_id'];

            $getProduct = $this->modelProduct->getProductById($product_id);

            if (empty($product_id)) {
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

    public function userByVerification()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            if (!isset($_SESSION['user_id'])) {
                header("Location: /login");
            } else {
                $products = $this->modelProduct->getProduct();

                if (empty($products)) {
                    return 'Are no products';
                } else {
                    require_once './../View/add_product.php';
                }
            }
        }
    }
}