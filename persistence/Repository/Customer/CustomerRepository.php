<?php

namespace Persistence\Repository\Customer;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Module\Auth\Data\Customer;
use Module\Auth\Repository\CustomerRepositoryInterface;
use Module\Customer\Repository\CustomerListRepositoryInterface;

class CustomerRepository extends EntityRepository implements CustomerListRepositoryInterface, CustomerRepositoryInterface
{

    public function getList(): array
    {
        return $this->findAll();
    }

    /**
     * @throws NonUniqueResultException
     */
    public function getOneByLogin(string $login): ?Customer
    {
        /** @var \Persistence\Entity\Customer\Customer $customer */
        $customer = $this->createQueryBuilder('c')
            ->where('c.email = :login')
            ->setParameter('login', $login)
            ->getQuery()
            ->getOneOrNullResult();

        if( null !== $customer )
        {
            return new Customer(
                $customer->getFirstName(),
                $customer->getLastname(),
                $customer->getEmail(),
                '-',
                $customer->getEmail(),
                $customer->getPassword()
            );
        }

        return null;
    }
}