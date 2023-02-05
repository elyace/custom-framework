<?php

namespace Module\Customer\UseCases;

use Module\Customer\Repository\CustomerListRepositoryInterface;


final class ListCustomer
{

    public function __construct(readonly private CustomerListRepositoryInterface $customerListRepository)
    {
    }

    public function execute(): array
    {
        return $this->customerListRepository->getList();
    }
}