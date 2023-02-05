<?php

namespace Module\Auth\Repository;

use Module\Auth\Data\AuthenticatedCustomer;

interface CustomerProviderRepositoryInterface
{
    public function findCurrentCustomer(): ?AuthenticatedCustomer;
}