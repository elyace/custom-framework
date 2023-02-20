<?php

namespace Module\Customer\Repository;

use Module\Customer\Data\CustomerList;

interface CustomerListRepositoryInterface
{
    public function getList(int $page = 1, int $limit = 10): CustomerList;
}