<?php

use Doctrine\ORM\EntityManagerInterface;
use Module\Auth\Repository\CustomerProviderRepositoryInterface;
use Module\Auth\Repository\CustomerRepositoryInterface;
use Module\Customer\Repository\CustomerListRepositoryInterface;
use Persistence\Entity\Customer\Customer;
use Persistence\Repository\Session\CustomerProviderRepository;
use Psr\Container\ContainerInterface;

return [
    CustomerRepositoryInterface::class => DI\factory(function (ContainerInterface $container){
        /** @var EntityManagerInterface $manager */
        $manager = $container->get(EntityManagerInterface::class);

        return $manager->getRepository(Customer::class);
    }),
    CustomerListRepositoryInterface::class => DI\factory(function (ContainerInterface $container){

        return $container->get(CustomerRepositoryInterface::class);
    }),
    CustomerProviderRepositoryInterface::class => DI\autowire(CustomerProviderRepository::class),
];