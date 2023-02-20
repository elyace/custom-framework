<?php

namespace Persistence\Repository\Mock;

use Module\Customer\Repository\CustomerListRepositoryInterface;

/**
 * @deprecated
 */
final class CustomerListRepository /*implements CustomerListRepositoryInterface*/
{

    public function getList(int $page = 1, int $limit = 10): array
    {
        $customers = file_get_contents( ROOT_PATH . '/public/mock/customers.json' );

        return json_decode($customers, true);
    }
}