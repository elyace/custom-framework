<?php

use Module\Auth\Validator\CustomerCredentialValidator;
use Module\Auth\Validator\CustomerCredentialValidatorInterface;

return [
    CustomerCredentialValidatorInterface::class => DI\create(CustomerCredentialValidator::class),
];