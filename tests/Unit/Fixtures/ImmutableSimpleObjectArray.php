<?php

declare(strict_types=1);

namespace TypedArrays\Tests\Unit\Fixtures;

use TypedArrays\AbstractTypedArray;

final class ImmutableSimpleObjectArray extends AbstractTypedArray
{
    protected function enforceType(): string
    {
        return SimpleObject::class;
    }

    protected function isMutable(): bool
    {
        return false;
    }
}
