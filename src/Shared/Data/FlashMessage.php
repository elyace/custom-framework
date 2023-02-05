<?php

namespace CFM\Shared\Data;

final class FlashMessage
{
    const INFO = 'info';
    const NOTICE = 'notice';
    const SUCCESS = 'success';
    const WARNING = 'warning';
    const DANGER = 'danger';

    public function __construct(public readonly string $level, public readonly string $message)
    {
    }
}