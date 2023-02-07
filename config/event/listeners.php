<?php

use CFM\Event\AuthenticatedCustomerEvent;
use CFM\Event\Listener\AuthenticatedCustomerEventListener;
use CFM\Event\Listener\InvalidCredentialsExceptionEventListener;
use CFM\Event\Listener\SendEmailEventListener;
use CFM\Event\ModuleExceptionEvent;
use CFM\Event\SendEmailEvent;

return [
    AuthenticatedCustomerEventListener::class => [
        AuthenticatedCustomerEvent::class
    ],
    InvalidCredentialsExceptionEventListener::class => [
        ModuleExceptionEvent::class
    ],
    SendEmailEventListener::class => [
        SendEmailEvent::class
    ]
];