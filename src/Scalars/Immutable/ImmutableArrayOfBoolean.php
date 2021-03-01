<?php

declare(strict_types=1);

namespace ArrayOf\Scalars\Immutable;

use ArrayOf\AbstractArrayOf;
use ArrayOf\Traits\Immutable;

final class ImmutableArrayOfBoolean extends AbstractArrayOf
{
    use Immutable;

    protected function typeToEnforce(): string
    {
        return self::SCALAR_BOOLEAN;
    }
}
