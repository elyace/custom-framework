<?php

namespace Module\Auth\Data;

use DateTimeImmutable;

final class AuthenticatedCustomer
{

    public function __construct(
        public readonly Customer $customer,
        public readonly DateTimeImmutable $lastAuth
    )
    {
    }
}