<?php

use CFM\Event\AuthenticatedCustomerEvent;
use CFM\Event\Listener\AuthenticatedCustomerEventListener;
use CFM\Event\Listener\InvalidCredentialsExceptionEventListener;
use CFM\Event\ModuleExceptionEvent;

return [
    AuthenticatedCustomerEventListener::class => [
        AuthenticatedCustomerEvent::class
    ],
    InvalidCredentialsExceptionEventListener::class => [
        ModuleExceptionEvent::class
    ]
];