<?php

namespace Persistence\Repository\Session;

use CFM\Event\Listener\AuthenticatedCustomerEventListener;
use CFM\Shared\Storage\KeyValueStorageInterface;
use Module\Auth\Data\AuthenticatedCustomer;
use Module\Auth\Repository\CustomerProviderRepositoryInterface;

class CustomerProviderRepository implements CustomerProviderRepositoryInterface
{

    public function __construct(private readonly KeyValueStorageInterface $session)
    {
    }

    public function findCurrentCustomer(): ?AuthenticatedCustomer
    {
        return $this->session->get(AuthenticatedCustomerEventListener::CURRENT_USER, null);
    }
}