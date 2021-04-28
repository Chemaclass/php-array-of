<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit\Fixtures;

use TypedArrays\AbstractTypedArray;

final class NullableSimpleObjectArray extends AbstractTypedArray
{
    protected function enforceType(): string
    {
        return SimpleObject::class;
    }

    protected function isMutable(): bool
    {
        return true;
    }

    protected function isNullable(): bool
    {
        return true;
    }
}
