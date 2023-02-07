<?php

namespace Module\Auth\Repository;

use Module\Auth\Data\Customer;

interface CustomerRepositoryInterface
{
    public function getOneByLogin(string $login): ?Customer;
}