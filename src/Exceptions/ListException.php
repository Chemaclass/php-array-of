<?php

declare(strict_types=1);

namespace ArrayOf\Exceptions;

use Exception;

final class ListException extends Exception
{
    public static function keysNotAllowed(): self
    {
        return new self('This ArrayOf object is a list and can not have keys.');
    }
}
