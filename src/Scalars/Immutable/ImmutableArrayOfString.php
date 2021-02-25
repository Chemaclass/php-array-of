<?php

declare(strict_types=1);

namespace ArrayOf\Scalars\Immutable;

use ArrayOf\ImmutableArrayOf;

final class ImmutableArrayOfString extends ImmutableArrayOf
{
    protected function typeToEnforce(): string
    {
        return self::SCALAR_STRING;
    }
}
