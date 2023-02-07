<?php

use Module\Auth\UseCases\CustomerAuthenticator;

class CustomerAuthenticatorIntegrationTest extends BaseTest
{

    public function testDependencyInjections()
    {
        $useCase = $this->container->get(CustomerAuthenticator::class);
        self::assertInstanceOf(CustomerAuthenticator::class, $useCase);
    }
}