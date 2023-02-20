<?php

namespace Module\Customer\Data;

final class CustomerList
{
    /**
     * @param array<int, Customer> $customers
     * @param int $totalCount
     * @param int $pageCount
     */
    public function __construct(
        public readonly array $customers,
        public readonly int $totalCount,
        public readonly int $pageCount,
    )
    {
    }
}