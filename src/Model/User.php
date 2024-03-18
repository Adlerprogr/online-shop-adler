<?php

class User
{
    public function create(string $firstName, string $lastName, string $email, $password):void
    {
        $pdo = new PDO("pgsql:host=db; port=5432; dbname=laravel", "root", "root");

        $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)");
        $stmt->execute(['first_name' => $firstName, 'last_name' => $lastName, 'email' => $email, 'password' => $password]);
    }

    public function getUserByEmail(string $email)
    {
        $pdo = new PDO("pgsql:host=db; port=5432; dbname=laravel", "root", "root");

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        return $user;;
    }
}