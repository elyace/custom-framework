<?php

namespace Module\Auth\Data;

final class Customer
{
    public function __construct(
        readonly public string $login,
        readonly public string $hashedPassword
    )
    {
    }
}