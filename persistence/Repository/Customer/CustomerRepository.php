<?php

namespace Persistence\Repository\Customer;

use Doctrine\ORM\EntityRepository;
use Module\Auth\Data\Customer;
use Module\Auth\Repository\CustomerRepositoryInterface;
use Module\Customer\Repository\CustomerListRepositoryInterface;

class CustomerRepository extends EntityRepository implements CustomerListRepositoryInterface, CustomerRepositoryInterface
{

    public function getList(): array
    {
        return $this->findAll();
    }

    public function findByLogin(string $login): ?Customer
    {
        /** @var \Persistence\Entity\Customer\Customer $customer */
        $customer = $this->findOneBy(['login', $login]);
        if( null !== $customer )
        {
            return new Customer($customer->getEmail(), $customer->getPassword());
        }

        return null;
    }
}