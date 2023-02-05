<?php

namespace CFM\Shared\Event;

interface EventManagerInterface
{
    public function subscribe(string $eventClass, string $listener): EventManagerInterface;
    public function unsubscribe(string $eventClass, string $listener): EventManagerInterface;
    public function notify(object $event): void;
}