<?php

namespace Persistence\Seeder;

use Doctrine\ORM\EntityManagerInterface;
use Persistence\Entity\Customer\Customer;

final class CustomerSeeder implements SeederInterface
{

    public function __construct(private readonly EntityManagerInterface $manager)
    {
    }

    public function run(): void
    {
        $manager = $this->manager;
        $data = file_get_contents( __DIR__ . '/../../public/mock/customers.json' );
        $customers = json_decode($data, true);
        foreach ($customers as $customer) {
            $customerEntity = new Customer();
            $customerEntity->setEmail($customer['email']);
            $customerEntity->setFirstName($customer['first_name']);
            $customerEntity->setLastname($customer['last_name']);
            $customerEntity->setPassword('$2a$12$OUfR0PjWpSvDCFkxuibzjeeolXPwPJiaFMIarQUYvFSg3DMUPSULq'); // password
            $manager->persist($customerEntity);
        }

        $manager->flush();
    }
}