<?php

class User extends Model
{
    public function create(string $firstName, string $lastName, string $email, $password, $repeatPassword):void
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (first_name, last_name, email, password, repeat_password) VALUES (:first_name, :last_name, :email, :password, :repeat_password)");
        $stmt->execute(['first_name' => $firstName, 'last_name' => $lastName, 'email' => $email, 'password' => $password, 'repeat_password' => $repeatPassword]);
    }

    public function getUserByEmail(string $email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        return $user;
    }

    public function getUserById(int $userId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $userId]);
        $getUser = $stmt->fetch();

        return $getUser;
    }
}