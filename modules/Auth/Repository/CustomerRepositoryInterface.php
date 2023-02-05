<?php

namespace Module\Auth\Repository;

use Module\Auth\Data\Customer;

interface CustomerRepositoryInterface
{
    public function findByLogin(string $login): ?Customer;
}