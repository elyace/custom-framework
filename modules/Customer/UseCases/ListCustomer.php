<?php

namespace Module\Customer\UseCases;

use Module\Customer\Data\CustomerList;
use Module\Customer\Repository\CustomerListRepositoryInterface;


final class ListCustomer
{

    public function __construct(readonly private CustomerListRepositoryInterface $customerListRepository)
    {
    }

    public function execute(int $page = 1, int $limit = 10): CustomerList
    {
        return $this->customerListRepository->getList($page, $limit);
    }
}