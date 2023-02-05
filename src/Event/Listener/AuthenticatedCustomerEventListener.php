<?php

namespace CFM\Event\Listener;

use CFM\Event\AuthenticatedCustomerEvent;
use CFM\Shared\Event\EventListenerInterface;
use CFM\Shared\Storage\KeyValueStorageInterface;

class AuthenticatedCustomerEventListener implements EventListenerInterface
{
    const CURRENT_USER = 'current-user';

    public function __construct(private readonly KeyValueStorageInterface $session)
    {
    }

    /**
     * @param AuthenticatedCustomerEvent $event
     * @return void
     */
    public function handle($event): void
    {
        $this->session->set(self::CURRENT_USER, $event->customer);
    }
}