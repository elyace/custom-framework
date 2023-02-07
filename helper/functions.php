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

if( !function_exists('camel_to_snake') )
{
    function camel_to_snake($input): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $input));
    }
}

if( !function_exists('snake_to_camel') )
{
    function snake_to_camel($input): string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $input))));
    }
}
