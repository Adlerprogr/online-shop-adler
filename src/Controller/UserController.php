<?php

class UserController
{
    public function getRegistrate()
    {
        require_once './../View/registrate.php';
    }

    public function userRegistrate()
    {
        //if (validateRegistrate($_POST)) {
        //    $pdo = new PDO("pgsql:host=db; port=5432; dbname=laravel", "root", "root");
        ////}

        $errors = $this->validateRegistrate($_POST);

        if (empty($errors)) {

            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $repeatPassword = $_POST['repeat_password'];

            require_once './../Model/User.php';
            $userModel = new User();
            $userModel->create($firstName, $lastName, $email, $password);
        }

        require_once './../View/registrate.php';
    }

    private function validateRegistrate(array $arr):array
    {
        $errors = [];

        if (isset($arr['first_name'])) {
            $firstName = $arr['first_name'];

            if (empty($firstName)) {
                $errors['first_name'] = 'FirstName not be empty';
            } elseif (strlen($firstName) < 2) {
                $errors['first_name'] =  'FirstName cannot have less than 2 characters';
            }
        } else {
            $errors['first_name'] =  'FirstName must be fill';
        }

        if (isset($arr['last_name'])) {
            $lastName = $arr['last_name'];

            if (empty($lastName)) {
                $errors['last_name'] =  'LastName not be empty';
            } elseif (strlen($lastName) < 2) {
                $errors['last_name'] =  'LastName cannot have less than 2 characters';
            }
        } else {
            $errors['last_name'] =  'LastName must be fill';
        }

        if (isset($arr['email'])) {
            $email = $arr['email'];

            require_once './../Model/User.php';
            $userModel = new User();
            $getEmail = $userModel->getUserByEmail($email);

            if ($getEmail === true) {
                $errors['email'] =  'UserController with such email already exists';
            } elseif (empty($email)) {
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
            } elseif (strlen($password) < 8) {
                $errors['password'] =  'Password cannot have less than 8 characters';
            }
        } else {
            $errors['password'] =  'Password must be fill';
        }

        if (isset($arr['repeat_password'])) {
            $repeatPassword = $arr['repeat_password'];

            if ($password !== $repeatPassword) {
                $errors['repeat_password'] =  'Repeat password not match';
            }
        } else {
            $errors['repeat_password'] =  'Repeat passwordmust be fill';
        }

        return $errors;
    }

    public function getLogin()
    {
        require_once './../View/login.php';
    }

    public function systemLogin()
    {
        $errors = $this->validateLogin($_POST);

        if (empty($errors)) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            require_once './../Model/User.php';
            $userModel = new User();
            $getEmail = $userModel->getUserByEmail($email);

            if (!empty($getEmail)) {
                if (password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    header("Location: /main.php");
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