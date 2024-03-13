<?php

$arr = $_POST;
function validateLogin(array $arr):array
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
$errors = validateLogin($arr);

if (empty($errors)) {
    $pdo = new PDO("pgsql:host=db; port=5432; dbname=laravel", "root", "root");

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!empty($user)) {
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

//    print_r($result);
}

require_once './login.php';