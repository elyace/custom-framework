<?php

namespace CFM\Presenter\Customer;

use Persistence\Entity\Customer\Customer;

class CustomerPresenterFactory
{
    public static function makeFromEntity(Customer $customer): CustomerPresenter
    {
        return new CustomerPresenter(
            $customer->getId(),
            $customer->getFirstName(),
            $customer->getLastname(),
            $customer->getEmail(),
            '-' // @todo add address information
        );
    }

    /**
     * @param array<Customer> $customers
     * @return array<CustomerPresenter>
     */
    public static function makeCollectionFromEntities(array $customers): array
    {
        return array_map(function (Customer $customer){ return self::makeFromEntity($customer); }, $customers);
    }
}