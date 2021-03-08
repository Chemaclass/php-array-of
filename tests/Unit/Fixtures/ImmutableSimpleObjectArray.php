<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit\Fixtures;

use TypedArrays\AbstractTypedArray;

final class ImmutableSimpleObjectArray extends AbstractTypedArray
{
    protected function typeToEnforce(): string
    {
        return SimpleObject::class;
    }

    protected function isMutable(): bool
    {
        return false;
    }
}
