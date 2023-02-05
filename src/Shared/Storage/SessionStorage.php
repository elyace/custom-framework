<?php

namespace CFM\Shared\Storage;

class SessionStorage implements KeyValueStorageInterface
{

    public function __construct()
    {
        session_start();
    }

    public function get(string $key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    public function set(string $key, $value): KeyValueStorageInterface
    {
        $_SESSION[$key] = $value;

        return $this;
    }

    public function delete(string $key): KeyValueStorageInterface
    {
        unset($_SESSION[$key]);

        return $this;
    }

    public function flush(): KeyValueStorageInterface
    {
        session_destroy();
    }
}