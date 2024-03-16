<?php

class MainController
{
    public function getMain():void
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
//        session_start();
//        if (!isset($_SESSION['user_id'])) {
//            header("Location: /login.php");
//        }

        require_once './../Model/Main.php';
        $mainModel = new Main();
        $products = $mainModel->getProduct();

        if (empty($products)) {
            echo 'Are no products';
            die();
        }

        require_once './../View/main.php';
    }
}