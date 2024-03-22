<?php

class User extends Model
{
    public function create(string $firstName, string $lastName, string $email, $password, $repeat_password):void
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (first_name, last_name, email, password, repeat_password) VALUES (:first_name, :last_name, :email, :password, :repeat_password)");
        $stmt->execute(['first_name' => $firstName, 'last_name' => $lastName, 'email' => $email, 'password' => $password, 'repeat_password' => $repeat_password]);
    }

    public function getUserByEmail(string $email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        return $user;
    }

    public function getUserById(int $user_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $user_id]);
        $getUser = $stmt->fetch();

        return $getUser;
    }
}