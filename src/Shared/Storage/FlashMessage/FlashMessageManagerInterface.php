<?php

namespace CFM\Shared\Storage\FlashMessage;

interface FlashMessageManagerInterface
{
    public function write(string $level, string $message): void;
    public function read(): array;
    public function flush():void;
}