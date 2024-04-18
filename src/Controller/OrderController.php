<?php

namespace Controller;

use Model\Order;
use Model\OrderProduct;
use Model\UserProduct;

class OrderController
{
    private Order $modelOrder;
    private OrderProduct $modelOrderProduct;
    private UserProduct $modelUserProduct;

    public function __construct()
    {
        $this->modelOrder = new Order();
        $this->modelOrderProduct = new OrderProduct();
        $this->modelUserProduct = new UserProduct();
    }

    public function getOrder()
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        }

        require_once './../View/Order.php';
    }

    public function postOrder(array $arr)
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

        $errors = $this->validateOrder($arr);

        if (empty($errors)) {
            $user_id = $_SESSION['user_id'];

            $email = $arr['email'];
            $phone = $arr['phone'];
            $name = $arr['name'];
            $address = $arr['address'];
            $city = $arr['city'];
            $postal_code = $arr['postal_code'];
            $country = $arr['country'];

            $checkOrderId = $this->modelOrder->createOrder($email, $phone, $name, $address, $city, $postal_code, $country);

            $this->modelOrderProduct->createOrderProduct();

        }

        require_once '../View/Order.php';
    }

    private function validateOrder(array $arr)
    {
        $errors = [];

        if (isset($arr['email'])) {
            $email = $arr['email'];

            if (empty($email)) {
                $errors['email'] = 'Email not be empty';
            } elseif (strlen($email) < 2) {
                $errors['email'] = 'The length of the email must exceed 2 characters';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Invalid email address';
            }
        } else {
            $errors['email'] =  'Email must be fill';
        }

        if (isset($arr['phone'])) {
            $phone = $arr['phone'];

            if (empty($phone)) {
                $errors['phone'] = 'Phone number not be empty';
            } elseif (strlen($phone) !== 11) {
                $errors['phone'] = 'The length of the phone number must be equal to 11 characters';
            }  elseif (!in_array($phone[0], ['7'])) {
                $errors['phone'] = 'The phone number must start with the number 7';
            }
        } else {
            $errors['phone'] = 'The phone number must be filled';
        }

        if (isset($arr['name'])) {
            $name = $arr['name'];

            if (empty($name)) {
                $errors['name'] = 'Name not be empty';
            } elseif (strlen($name) < 2) {
                $errors['name'] = 'The length of the name must exceed 2 characters';
            } elseif (!preg_match('/^[a-zA-Z0-9]+_?[a-zA-Z0-9]+$/D', $name)) {
                $errors['name'] = 'Invalid user name';
            }
        } else {
            $errors['name'] = 'The name must be filled';
        }

        if (isset($arr['address'])) {
            $address = $arr['address'];

            if (empty($address)) {
                $errors['address'] = 'Address not be empty';
            } elseif (strlen($address) < 20) {
                $errors['address'] = 'The length of the address cannot be less than 20 characters';
            }
        } else {
            $errors['address'] = 'The address must be filled';
        }

        if (isset($arr['city'])) {
            $city = $arr['city'];

            if (empty($city)) {
                $errors['city'] = 'City not be empty';
            } elseif (strlen($city) < 2) {
                $errors['city'] = 'The length of the city must exceed 2 characters';
            }
        } else {
            $errors['city'] = 'The city must be filled';
        }

        if (isset($arr['postal_code'])) {
            $postal_code = $arr['postal_code'];

            if (empty($postal_code)) {
                $errors['postal_code'] = 'Postal Code not be empty';
            } elseif (!preg_match_all('/[0-9]/', $postal_code)) {
                $errors['postal_code'] = 'Incorrect postal code';
            } elseif (strlen($postal_code) !== 6) {
                $errors['postal_code'] = 'The zip code must contain 6 characters';
            }
        } else {
            $errors['postal_code'] = 'The postal code must be filled';
        }

        if (isset($arr['country'])) {
            $country = $arr['country'];

            if (empty($country)) {
                $errors['country'] = 'Country not be empty';
            } elseif (strlen($country) < 2) {
                $errors['country'] = 'The length of the country must exceed 2 characters';
            }
        } else {
            $errors['country'] = 'The country must be filled';
        }

        return $errors;
    }
}