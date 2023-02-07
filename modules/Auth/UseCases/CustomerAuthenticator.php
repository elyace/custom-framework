<?php

namespace Module\Auth\UseCases;

use DateTimeImmutable;
use Module\Auth\Data\AuthenticatedCustomer;
use Module\Auth\Data\CustomerCredentials;
use Module\Auth\Exception\InvalidCustomerCredentials;
use Module\Auth\Repository\CustomerRepositoryInterface;
use Module\Auth\Validator\CustomerCredentialValidatorInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

final class CustomerAuthenticator
{

    public function __construct(
        readonly private CustomerRepositoryInterface $customerRepository,
        readonly private PasswordHasherInterface $passwordChecker,
        readonly private CustomerCredentialValidatorInterface $validator
    )
    {
    }

    /**
     * @throws InvalidCustomerCredentials
     */
    public function execute(CustomerCredentials $credentials): AuthenticatedCustomer
    {

        $this->validator->validate($credentials);

        $customer = $this->customerRepository->getOneByLogin($credentials->login);

        if( null === $customer )
        {
            throw new InvalidCustomerCredentials("Customer with login $credentials->login does not exists");
        }

        if( !$this->passwordChecker->verify($customer->hashedPassword, $credentials->password) )
        {
            throw new InvalidCustomerCredentials("Invalid credentials");
        }

        return new AuthenticatedCustomer(
            $customer->firstName,
            $customer->lastName,
            $customer->email,
            $customer->address,
            new DateTimeImmutable('now'));
    }
}