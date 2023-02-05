<?php

namespace Persistence\Repository\Mock;

use Module\Auth\Data\Customer;
use Module\Auth\Repository\CustomerRepositoryInterface;

final class CustomerRepository implements CustomerRepositoryInterface
{

    public function findByLogin(string $login): ?Customer
    {
        return new Customer($login, '$2a$12$OUfR0PjWpSvDCFkxuibzjeeolXPwPJiaFMIarQUYvFSg3DMUPSULq');
    }
}