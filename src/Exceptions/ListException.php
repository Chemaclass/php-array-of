<?php

declare(strict_types=1);

namespace TypedArrays\Exceptions;

use Exception;

final class ListException extends Exception
{
    public static function keysNotAllowed(): self
    {
        return new self('This TypedArray object is a list and can not have keys.');
    }
}
