<?php

namespace Module\Auth\Data;

final class CustomerCredentials
{
    public function __construct(
        readonly public string $login,
        readonly public string $password
    )
    {
    }
}