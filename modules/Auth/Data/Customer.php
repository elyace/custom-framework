<?php

namespace Module\Auth\Data;

final class Customer
{
    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $email,
        public readonly string $address,
        readonly public string $login,
        readonly public string $hashedPassword
    )
    {
    }
}