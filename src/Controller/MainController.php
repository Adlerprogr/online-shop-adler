<?php

class MainController
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