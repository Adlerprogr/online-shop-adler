<?php

namespace Controller;

use Model\User;

class UserController
{
    private User $modelUser;

    public function __construct()
    {
        $this->modelUser = new User();
    }

    public function getRegistration():void
    {
        require_once './../View/registration.php';
    }

    public function postRegistration(array $arr):void
    {
        $errors = $this->validateRegistration($arr);

        if (empty($errors)) {
            $firstName = $arr['first_name'];
            $lastName = $arr['last_name'];
            $email = $arr['email'];
            $password = password_hash($arr['password'], PASSWORD_DEFAULT);
            $repeatPassword = password_hash($arr['repeat_password'], PASSWORD_DEFAULT);

            $this->modelUser->create($firstName, $lastName, $email, $password, $repeatPassword);
        }

        require_once './../View/login.php';
    }

    private function validateRegistration(array $arr):array
    {
        $errors = [];

        if (isset($arr['first_name'])) {
            $firstName = $arr['first_name'];

            if (empty($firstName)) {
                $errors['first_name'] = 'FirstName not be empty';
            } elseif (strlen($firstName) < 2) {
                $errors['first_name'] = 'FirstName cannot have less than 2 characters';
            }
        } else {
            $errors['first_name'] = 'FirstName must be fill';
        }

        if (isset($arr['last_name'])) {
            $lastName = $arr['last_name'];

            if (empty($lastName)) {
                $errors['last_name'] = 'LastName not be empty';
            } elseif (strlen($lastName) < 2) {
                $errors['last_name'] = 'LastName cannot have less than 2 characters';
            }
        } else {
            $errors['last_name'] = 'LastName must be fill';
        }

        if (isset($arr['email'])) {
            $email = $arr['email'];

            $getEmail = $this->modelUser->getUserByEmail($email); // !!! object User

            if ($getEmail !== null) {
                $errors['email'] = 'UserController with such email already exists';
            } elseif (empty($email)) {
                $errors['email'] = 'Email not be empty';
            } elseif (strlen($email) < 2) {
                $errors['email'] = 'The length of the email must exceed 2 characters';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Invalid email address';
            }
        } else {
            $errors['email'] = 'Email must be fill';
        }

        if (isset($arr['password'])) {
            $password = $arr['password'];

            if (empty($password)) {
                $errors['password'] = 'Password not be empty';
            } elseif (strlen($password) < 8) {
                $errors['password'] = 'Password cannot have less than 8 characters';
            }
        } else {
            $errors['password'] = 'Password must be fill';
        }

        if (isset($arr['repeat_password'])) {
            $repeatPassword = $arr['repeat_password'];

            if ($password !== $repeatPassword) {
                $errors['repeat_password'] = 'Repeat password not match';
            }
        } else {
            $errors['repeat_password'] = 'Repeat password must be fill';
        }

        return $errors;
    }

    public function getLogin():void
    {
        require_once './../View/login.php';
    }

    public function postLogin(array $arr):void
    {
        $errors = $this->validateLogin($arr);

        if (empty($errors)) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $getEmail = $this->modelUser->getUserByEmail($email); // !!! object User

            if (!empty($getEmail)) {
                if (password_verify($password, $getEmail->getPassword())) {
                    session_start();
                    $_SESSION['user_id'] = $getEmail->getId();
                    header("Location: /main");
                } else {
                    echo 'The email or password is not correct';
                }
            } else {
                echo 'The email or password is not correct';
            }
        }

        require_once './../View/login.php';
    }

    private function validateLogin(array $arr):array
    {
        $errors = [];

        if (isset($arr['email'])) {
            $email = $arr['email'];

            if (empty($email)) {
                $errors['email'] =  'Email not be empty';
            } elseif (strlen($email) < 2) {
                $errors['email'] =  'Email cannot have less than 2 characters';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] =  'Invalid email address';
            }
        } else {
            $errors['email'] =  'Email must be fill';
        }

        if (isset($arr['password'])) {
            $password = $arr['password'];

            if (empty($password)) {
                $errors['password'] =  'Password not be empty';
            }
        } else {
            $errors['password'] =  'Password must be fill';
        }

        return $errors;
    }
}