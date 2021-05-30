<?php

declare(strict_types=1);

namespace TypedArrays\Tests\Unit\Fixtures;

use TypedArrays\AbstractTypedArray;

final class NonNullableSimpleObjectArray extends AbstractTypedArray
{
    protected function enforceType(): string
    {
        return SimpleObject::class;
    }

    protected function isNullable(): bool
    {
        return false;
    }
}
