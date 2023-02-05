<?php

namespace CFM\Shared\Attribute;

use Attribute;

#[Attribute]
final class Security
{

    public const UNSECURE = 'unsecure';
    public const SECURE = 'secure';

    public function __construct(public readonly string $level = self::UNSECURE, public readonly ?string $redirectPath = null)
    {
    }

    public function needSecurity(): bool
    {
        return $this->level === self::SECURE;
    }
}