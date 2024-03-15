<?php

class Main
{
    public function getMain():void
    {
        require_once './../View/main.php';
    }

    public function userVerification():void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            if (!isset($_SESSION['user_id'])) {
                header("Location: /login.php");
            }
        } else {
            if (!isset($_SESSION['user_id'])) {
                header("Location: /login.php");
            }
        }
//        session_start();
//        if (!isset($_SESSION['user_id'])) {
//            header("Location: /login.php");
//        }

        $pdo = new PDO("pgsql:host=db; port=5432; dbname=laravel", "root", "root");

        $stmt = $pdo->query("SELECT * FROM products");
        $products = $stmt->fetchAll();

        if (empty($products)) {
            echo 'Are no products';
            die();
        }

        require_once './../View/main.php';
    }
}