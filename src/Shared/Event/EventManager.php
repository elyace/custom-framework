<?php

namespace CFM\Shared\Event;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class EventManager implements EventManagerInterface
{

    private array $listeners = [];

    public function __construct(private readonly ContainerInterface $container)
    {
    }

    public function subscribe(string $eventClass, string $listener): EventManagerInterface
    {
        $this->listeners[$listener][] = $eventClass;

        return $this;
    }

    public function unsubscribe(string $eventClass, string $listener): EventManagerInterface
    {
        unset($this->listeners[$listener][$eventClass]);

        return $this;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function notify(object $event): void
    {
        /**
         * @var EventListenerInterface $listener
         * @var array<string> $eventClass
         */
        foreach ($this->listeners as $listenerClass => $eventClass) {
            if( in_array($event::class, $eventClass) )
            {
                /** @var EventListenerInterface $listener */
                $listener = $this->container->get($listenerClass);
                $listener->handle($event);
            }
        }
    }
}