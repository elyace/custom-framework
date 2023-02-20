<?php

namespace CFM\Presenter\Customer;

use Module\Customer\Data\Customer;
use Module\Customer\Data\CustomerList;
use Persistence\Entity\Customer\Customer as CustomerEntity;

class CustomerPresenterFactory
{
    public static function makeFromEntity(CustomerEntity $customer): CustomerPresenter
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
     * @param CustomerList $customers
     * @return array<CustomerPresenter>
     */
    public static function makeCollection(CustomerList $customers): array
    {
        return array_map(function (Customer $customer){

            return new CustomerPresenter(
                $customer->id,
                $customer->firstName,
                $customer->lastName,
                $customer->email,
                '-',
            );

            }, $customers->customers
        );
    }

    public static function makePaginatedCollection(
        CustomerList $customers,
        string $last,
        ?string $nextPage,
        ?string $prevPage
    ): PaginationAwarePresenter
    {
        $collection = self::makeCollection($customers);

        return new PaginationAwarePresenter(
            $collection,
            $customers->pageCount,
            $customers->totalCount,
            $last,
            $nextPage,
            $prevPage
        );
    }
}