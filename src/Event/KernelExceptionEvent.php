<?php

namespace CFM\Event;

use Throwable;

final class KernelExceptionEvent
{
    public function __construct(public readonly Throwable $exception)
    {
    }
}