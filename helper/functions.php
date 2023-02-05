<?php

use CFM\Kernel;

if( !function_exists('env') ) {
    function env(string $key, mixed $default = null)
    {
        if (!array_key_exists($key, $_ENV)) return $default;

        return $_ENV[$key];
    }
}

if( !function_exists('dispatch') ) {
    function dispatch(object $event): void
    {
        $manager = Kernel::getInstance()->initEventListener();
        $manager->notify($event);
    }
}

if( !function_exists('redirect') ) {
    function redirect(string $path)
    {
        header("Location: $path");
        exit();
    }
}