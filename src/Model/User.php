<?php

namespace Model;

use Entity\UserEntity;

class User extends Model
{
    public function create(string $firstName, string $lastName, string $email, $password, $repeatPassword): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (first_name, last_name, email, password, repeat_password) VALUES (:first_name, :last_name, :email, :password, :repeat_password)");
        $stmt->execute(['first_name' => $firstName, 'last_name' => $lastName, 'email' => $email, 'password' => $password, 'repeat_password' => $repeatPassword]);
    }

    public function getUserByEmail(string $email): UserEntity|null
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if (empty($user)) {
            return null;
        }

        return new UserEntity($user['id'], $user['first_name'], $user['last_name'], $user['email'], $user['password'], $user['repeat_password']);
    }

    public function getUserById(int $userId): UserEntity|null
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $userId]);
        $getUser = $stmt->fetch();

        if (empty($getUser)) {
            return null;
        }

        return new UserEntity($getUser['id'], $getUser['first_name'], $getUser['last_name'], $getUser['email'], $getUser['password'], $getUser['repeat_password']);
    }
}