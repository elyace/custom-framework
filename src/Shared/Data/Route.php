<?php

namespace CFM\Shared\Data;

final class Route
{
    public function __construct(
        readonly public string $name,
        readonly public string $path,
        readonly public string $handler,
        readonly public array $methods = ['GET'],
    )
    {
    }

    public static function make(string $name, string $path, string $handler, array $method = ['GET']): Route
    {
        return new Route($name, $path, $handler, $method);
    }
}