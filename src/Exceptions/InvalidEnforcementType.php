<?php

declare(strict_types=1);

namespace ArrayOf\Exceptions;

use InvalidArgumentException;

final class InvalidEnforcementType extends InvalidArgumentException
{
    public static function forType(string $type): self
    {
        return new self("ArrayOf objects can only enforce scalars and objects. Tried to enforce: $type");
    }
}
