<?php

use Module\Auth\Repository\CustomerProviderRepositoryInterface;
use Module\Auth\Repository\CustomerRepositoryInterface;
use Module\Customer\Repository\CustomerListRepositoryInterface;
use Persistence\Repository\Mock\CustomerListRepository;
use Persistence\Repository\Mock\CustomerRepository;
use Persistence\Repository\Session\CustomerProviderRepository;

return [
    CustomerListRepositoryInterface::class => DI\create(CustomerListRepository::class),
    CustomerRepositoryInterface::class => DI\create(CustomerRepository::class),
    CustomerProviderRepositoryInterface::class => DI\autowire(CustomerProviderRepository::class),
];