<?php

namespace Module\Auth\Data;

use DateTimeImmutable;

final class AuthenticatedCustomer
{

    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $email,
        public readonly string $address,
        public readonly DateTimeImmutable $lastAuth,
    )
    {
    }
}