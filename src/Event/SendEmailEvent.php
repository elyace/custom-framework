<?php

namespace CFM\Event;

use Symfony\Component\Mime\Email;

final class SendEmailEvent
{

    public function __construct(public readonly Email $email)
    {
    }
}