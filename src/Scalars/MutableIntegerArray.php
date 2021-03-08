<?php

declare(strict_types=1);

namespace TypedArrays\Scalars;

use TypedArrays\AbstractTypedArray;

final class MutableIntegerArray extends AbstractTypedArray
{
    protected function typeToEnforce(): string
    {
        return self::SCALAR_INTEGER;
    }
}
