<?php

namespace Module\Auth\Test;

use BaseTest;
use DateTimeImmutable;
use Module\Auth\Data\AuthenticatedCustomer;
use Module\Auth\Data\Customer;
use Module\Auth\Data\CustomerCredentials;
use Module\Auth\Exception\InvalidCustomerCredentials;
use Module\Auth\Repository\CustomerRepositoryInterface;
use Module\Auth\UseCases\CustomerAuthenticator;
use Module\Auth\Validator\CustomerCredentialValidatorInterface;
use PHPUnit\Framework\MockObject\Exception;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

require_once dirname(__FILE__) . '/../../../tests/BaseTest.php';

class CustomerAuthenticatorTest extends BaseTest
{
    private CustomerAuthenticator $customerAuthenticator;
    private CustomerCredentialValidatorInterface $validator;
    private CustomerRepositoryInterface $customerRepository;
    private PasswordHasherInterface $passwordChecker;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->validator = $this->createMock(CustomerCredentialValidatorInterface::class);
        $this->customerRepository = $this->createMock(CustomerRepositoryInterface::class);
        $this->passwordChecker = $this->createMock(PasswordHasherInterface::class);

        $this->customerAuthenticator = new CustomerAuthenticator($this->customerRepository, $this->passwordChecker, $this->validator);
    }

    /**
     * @throws InvalidCustomerCredentials
     */
    public function testExecuteWithValidCredentials()
    {
        $credentials = new CustomerCredentials("testuser", "testpassword");
        $customer = new Customer("testuser", "hashedtestpassword");

        $this->validator->expects($this->once())
            ->method('validate')
            ->with($credentials);

        $this->customerRepository->expects($this->once())
            ->method('getOneByLogin')
            ->with("testuser")
            ->willReturn($customer);

        $this->passwordChecker->expects($this->once())
            ->method('verify')
            ->with("hashedtestpassword", "testpassword")
            ->willReturn(true);

        $result = $this->customerAuthenticator->execute($credentials);

        $this->assertInstanceOf(AuthenticatedCustomer::class, $result);
        $this->assertSame($customer, $result->customer);
        $this->assertInstanceOf(DateTimeImmutable::class, $result->lastAuth);
    }

    public function testExecuteWithNonExistingCustomer()
    {
        $credentials = new CustomerCredentials("nonexistentuser", "testpassword");

        $this->validator->expects($this->once())
            ->method('validate')
            ->with($credentials);

        $this->customerRepository->expects($this->once())
            ->method('getOneByLogin')
            ->with("nonexistentuser")
            ->willReturn(null);

        $this->expectException(InvalidCustomerCredentials::class);
        $this->expectExceptionMessage("Customer with login nonexistentuser does not exists");

        $this->customerAuthenticator->execute($credentials);
    }

    public function testExecuteWithWrongPassword()
    {
        $credentials = new CustomerCredentials("user", "testpassword");
        $customer = new Customer("testuser", "hashedtestpassword");

        $this->validator->expects($this->once())
            ->method('validate')
            ->with($credentials);

        $this->passwordChecker->expects($this->once())
            ->method('verify')
            ->with("hashedtestpassword", "testpassword")
            ->willReturn(false);

        $this->customerRepository->expects($this->once())
            ->method('getOneByLogin')
            ->with("user")
            ->willReturn($customer);

        $this->expectException(InvalidCustomerCredentials::class);
        $this->expectExceptionMessage("Invalid credentials");

        $this->customerAuthenticator->execute($credentials);
    }
}