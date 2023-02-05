<?php

namespace CFM\Shared\Event;

interface EventListenerInterface
{
    public function handle($event): void;
}