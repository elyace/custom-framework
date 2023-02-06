<?php

namespace Module\Auth\Validator;

use Assert\Assertion;
use Assert\AssertionFailedException;
use Module\Auth\Data\CustomerCredentials;
use Module\Auth\Exception\InvalidCustomerCredentials;

class CustomerCredentialValidator implements CustomerCredentialValidatorInterface
{

    /**
     * @throws InvalidCustomerCredentials
     */
    public function validate(CustomerCredentials $credentials): void
    {
        try {
            Assertion::notBlank($credentials->login, message: 'Password can not be blank');
            Assertion::notBlank($credentials->login, 'Login can not be blank');
            Assertion::email($credentials->login, 'Login must be a valid email');
        } catch (AssertionFailedException $e) {
            throw new InvalidCustomerCredentials($e->getMessage());
        }
    }
}