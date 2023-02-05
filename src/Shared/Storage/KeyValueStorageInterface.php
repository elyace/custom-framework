<?php

namespace CFM\Shared\Storage;

interface KeyValueStorageInterface
{

    public function get(string $key, $default = null);
    public function set(string $key, $value): KeyValueStorageInterface;
    public function delete(string $key): KeyValueStorageInterface;

    public function flush(): KeyValueStorageInterface;
}