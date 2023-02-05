<?php

namespace Module\Customer\Repository;

interface CustomerListRepositoryInterface
{
    public function getList(): array;
}