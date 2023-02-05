<?php

namespace CFM\Event\Listener;

use CFM\Event\ModuleExceptionEvent;
use CFM\Shared\Data\FlashMessage;
use CFM\Shared\Event\EventListenerInterface;
use CFM\Shared\Storage\FlashMessage\FlashMessageManagerInterface;
use Module\Auth\Exception\InvalidCustomerCredentials;

final class InvalidCredentialsExceptionEventListener implements EventListenerInterface
{

    public function __construct(private readonly FlashMessageManagerInterface $flashManager)
    {
    }

    /**
     * @param ModuleExceptionEvent $event
     * @return void
     */
    public function handle($event): void
    {
        if( $event->e instanceof InvalidCustomerCredentials )
        {
            $this->flashManager->write(FlashMessage::DANGER, 'Invalid credentials');
        }
    }
}