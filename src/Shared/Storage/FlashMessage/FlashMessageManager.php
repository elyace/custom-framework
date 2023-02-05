<?php

namespace CFM\Shared\Storage\FlashMessage;

use CFM\Shared\Data\FlashMessage;
use CFM\Shared\Storage\KeyValueStorageInterface;

class FlashMessageManager implements FlashMessageManagerInterface
{
    private const FLASH_MESSAGE_KEY = 'flash-message';

    public function __construct(private readonly KeyValueStorageInterface $sessionStorage)
    {
    }

    public function write(string $level, string $message): void
    {
        $flash = new FlashMessage($level, $message);
        $existing = $this->sessionStorage->get(self::FLASH_MESSAGE_KEY, []);
        $this->sessionStorage->set(self::FLASH_MESSAGE_KEY, array_merge($existing, [$flash]));
    }

    /**
     * @return array<FlashMessage>
     */
    public function read(): array
    {
        $messages = $this->sessionStorage->get(self::FLASH_MESSAGE_KEY, []);

        $this->flush();

        return $messages;
    }

    public function flush(): void
    {
        $this->sessionStorage->delete(self::FLASH_MESSAGE_KEY);
    }
}