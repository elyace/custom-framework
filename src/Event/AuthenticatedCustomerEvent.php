<?php

namespace CFM\Event;

use Module\Auth\Data\AuthenticatedCustomer;

final class AuthenticatedCustomerEvent
{
    public function __construct(public readonly AuthenticatedCustomer $customer)
    {
    }
}