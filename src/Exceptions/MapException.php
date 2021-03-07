<?php

declare(strict_types=1);

namespace TypedArrays\Exceptions;

use Exception;

final class MapException extends Exception
{
    public static function keysRequired(): self
    {
        return new self('This TypedArray object is a map and must have keys.');
    }
}
