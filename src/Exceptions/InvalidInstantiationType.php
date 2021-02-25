<?php

declare(strict_types=1);

namespace ArrayOf\Exceptions;

use InvalidArgumentException;

final class InvalidInstantiationType extends InvalidArgumentException
{
    public static function forType(string $className, string $actualType, string $expectedType): self
    {
        return new self(sprintf(
            'Tried to instantiate a %s with a %s. Only accepts objects of type %s.',
            $className,
            $actualType,
            $expectedType
        ));
    }
}
