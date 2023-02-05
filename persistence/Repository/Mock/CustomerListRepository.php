<?php

namespace Persistence\Repository\Mock;

use Module\Customer\Repository\CustomerListRepositoryInterface;

final class CustomerListRepository implements CustomerListRepositoryInterface
{

    public function getList(): array
    {
        $customers = file_get_contents( ROOT_PATH . '/public/mock/customers.json' );

        return json_decode($customers, true);
    }
}