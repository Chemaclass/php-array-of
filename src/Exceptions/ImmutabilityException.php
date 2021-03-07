<?php

declare(strict_types=1);

namespace TypedArrays\Exceptions;

use Exception;

final class ImmutabilityException extends Exception
{
    public function __construct()
    {
        parent::__construct('This TypedArray object is immutable.');
    }
}
