<?php

declare(strict_types=1);

namespace TypedArrays\Exceptions;

use Exception;

final class GuardException extends Exception
{
    public static function keysNotAllowedInList(): self
    {
        return new self('This TypedArray object is a list and can not have keys.');
    }

    public static function keysRequiredInMap(): self
    {
        return new self('This TypedArray object is a map and must have keys.');
    }

    public static function immutableCannotMutate(): self
    {
        return new self('This TypedArray object is immutable.');
    }
}
