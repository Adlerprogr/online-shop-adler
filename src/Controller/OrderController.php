<?php

namespace Controller;

class OrderController
{
    public function getOrder()
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        }

        require_once './../View/Order.php';
    }

    public function order(array $arr)
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

        $errors = $this->validateOrder();

        if (empty($errors)) {
            $user_id = $_SESSION['user_id'];

            $email = $arr['email'];
            $phone = $arr['phone'];
            $name = $arr['name'];
            $address = $arr['address'];
            $city = $arr['city'];
            $postcode = $arr['post_code'];
            $country = $arr['country'];



        }
    }

    private function validateOrder(array $arr)
    {

    }
}