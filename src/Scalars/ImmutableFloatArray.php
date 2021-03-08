<?php

declare(strict_types=1);

namespace TypedArrays\Scalars;

use TypedArrays\AbstractTypedArray;

final class ImmutableFloatArray extends AbstractTypedArray
{
    protected function typeToEnforce(): string
    {
        return self::SCALAR_DOUBLE;
    }

    protected function isMutable(): bool
    {
        return false;
    }
}
