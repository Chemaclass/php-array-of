<?php

declare(strict_types=1);

namespace TypedArrays\Scalars;

use TypedArrays\AbstractTypedArray;

final class ImmutableBooleanArray extends AbstractTypedArray
{
    protected function typeToEnforce(): string
    {
        return self::SCALAR_BOOLEAN;
    }

    protected function isMutable(): bool
    {
        return false;
    }
}
