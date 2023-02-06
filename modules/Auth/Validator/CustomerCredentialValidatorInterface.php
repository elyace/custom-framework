<?php

namespace Module\Auth\Validator;

use Module\Auth\Data\CustomerCredentials;

interface CustomerCredentialValidatorInterface
{
    public function validate(CustomerCredentials $credentials): void;
}