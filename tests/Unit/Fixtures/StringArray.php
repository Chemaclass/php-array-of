<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit\Fixtures;

use TypedArrays\AbstractTypedArray;

final class StringArray extends AbstractTypedArray
{
    protected function enforceType(): string
    {
        return self::SCALAR_STRING;
    }
}
