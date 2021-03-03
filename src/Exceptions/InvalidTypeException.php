<?php

declare(strict_types=1);

namespace ArrayOf\Exceptions;

use InvalidArgumentException;

final class InvalidTypeException extends InvalidArgumentException
{
    public static function onInstantiate(string $className, string $actualType, string $expectedType): self
    {
        return new self(
            "Tried to instantiate a {$className} with a {$actualType}. Only accepts objects of type {$expectedType}."
        );
    }

    public static function onAdd(string $className, string $actualType, string $expectedType): self
    {
        return new self(
            "Tried to add a {$actualType} with a {$className}. Only accepts objects of type {$expectedType}."
        );
    }
}
