<?php

namespace Model;

class Order extends Model
{
    public function createOrder(string $email, int $phone, string $name, string $address, string $city, string $postal_code, string $country): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO orders (email, phone, name, address, city, postal_code, country) OUTPUT Inserted.ID VALUES (:email, :phone, :name, :address, :city, :postal_code, :country)");
        $stmt->execute(['email' => $email, 'phone' => $phone, 'name' => $name, 'address' => $address, 'city' => $city, 'postal_code' => $postal_code, 'country' => $country]);
    }
}