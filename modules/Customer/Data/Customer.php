<?php

namespace Module\Customer\Data;

final class Customer
{
    public function __construct(
        public readonly int    $id,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $email,
        public readonly string $address,
    )
    {
    }
}