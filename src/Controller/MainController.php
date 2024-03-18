Hello World pic

<?php

require_once './../Model/Product.php';

class MainController
{
    private Product $modelProduct;

    public function __construct()
    {
        $this->modelProduct = new Product();
    }

    public function pathToPage():void
    {
        require_once './../View/main.php';
    }

    public function userVerification()
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

        $products = $this->modelProduct->getProduct();

        if (empty($products)) {
            return 'Are no products';
        } else {
            require_once './../View/main.php';
        }
    }
/////
//    public function addProduct(array $arr)
//    {
//        if (!isset($_SESSION['user_id'])) {
//            header("Location: /login");
//        } else {
//            $user_id = $_SESSION['user_id'];
//            $product_id = $arr['product_id'];
//            $quantity = $arr['quantity'];
//
//            $errors = $this->validateUserProduct($product_id, $quantity);
//
//            if(empty($errors)) {
//
//            } else {
//
//            }
//        }
//    }

//    private function validateUserProduct(array $arr): array
//    {
//        $errors = [];
//
//        if (isset($arr['product_id'])) {
//            $product_id = $arr['product_id'];
//
//            $getProduct = $this->modelProduct->getProductById($product_id);
//
//            if (empty($product_id)) {
//                $errors['product_id'] = 'The product id should not be empty';
//            } elseif ($getProduct === false) {
//                $errors['product_id'] = 'There is no such product';
//            }
//        } else {
//            $errors['product_id'] = 'The product id must be filled';
//        }
//
//        if (isset($arr['quantity'])) {
//            $quantity = $arr['quantity'];
//
//            if (empty($quantity)) {
//                $errors['quantity'] = 'The quantity should not be empty';
//            } elseif ($quantity <= 0) {
//                $errors['quantity'] = 'The number must be greater than 0';
//            }
//        } else {
//            $errors['quantity'] = 'The quantity must be filled';
//        }
//
//        return $errors;
//    }
}