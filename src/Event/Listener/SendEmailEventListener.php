<?php

namespace CFM\Event\Listener;

use CFM\Event\SendEmailEvent;
use CFM\Shared\Event\EventListenerInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;

final class SendEmailEventListener implements EventListenerInterface
{

    public function __construct(private readonly MailerInterface $mailer)
    {
    }

    /**
     * @param SendEmailEvent $event
     * @return void
     * @throws TransportExceptionInterface
     */
    public function handle($event): void
    {
        $this->mailer->send($event->email);
    }
}