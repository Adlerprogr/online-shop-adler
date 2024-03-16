<?php

class ProductController
{
    public function getAddProduct():void
    {
        require_once './../View/add_product.php';
    }

    public function addUsersProduct():void
    {
        $errors = $this->validateUserProduct($_POST);

        if (empty($errors)) {
            session_start();
            if (!isset($_SESSION['user_id'])) {
                header("Location: /login");
            }

            $user_id = $_SESSION['user_id'];
            $product_id = $_POST['product_id'];
            $quantity = $_POST['quantity'];

            require_once './../Model/Product.php';
            $productModel = new Product();
            $productModel->create($user_id, $product_id, $quantity);
        }

        require_once './../View/add_product.php';
    }

    private function validateUserProduct(array $arr): array
    {
        $errors = [];

        if (isset($arr['user_id'])) {
            $user_id = $arr['user_id'];

            require_once './../Model/Product.php';
            $productUser = new Product();
            $getUser = $productUser->getUserById($user_id);

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

            require_once './../Model/Product.php';
            $productUser = new Product();
            $getProduct = $productUser->getProductById($product_id);

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
}