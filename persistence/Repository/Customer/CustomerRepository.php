<?php

namespace Persistence\Repository\Customer;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Module\Auth\Data\Customer;
use Module\Customer\Data\Customer as CustomerData;
use Module\Auth\Repository\CustomerRepositoryInterface;
use Module\Customer\Data\CustomerList;
use Module\Customer\Repository\CustomerListRepositoryInterface;
use Persistence\Entity\Customer\Customer as CustomerEntity;
use Persistence\Paginator\Paginator;

class CustomerRepository extends EntityRepository implements CustomerListRepositoryInterface, CustomerRepositoryInterface
{

    use Paginator;

    public function getList(int $page = 1, int $limit = 10): CustomerList
    {
        $query = $this->createQueryBuilder('c')
            ->orderBy('c.id');

        $pages = $this->paginate($query, $page, $limit);

        $customers = array_map(function (CustomerEntity $entity){
            return new CustomerData(
                $entity->getId(),
                $entity->getFirstName(),
                $entity->getLastname(),
                $entity->getEmail(),
                '-'
            );
        }, $pages->getQuery()->getResult());
        $total = $pages->count();
        $pagesCount = ceil($total / $limit);

        return new CustomerList($customers, $total, $pagesCount);
    }

    /**
     * @throws NonUniqueResultException
     */
    public function getOneByLogin(string $login): ?Customer
    {
        /** @var CustomerEntity $customer */
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