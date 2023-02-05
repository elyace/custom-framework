<?php

namespace CFM\Event;

use Throwable;

final class ModuleExceptionEvent
{
    public function __construct(public readonly Throwable $e)
    {
    }
}