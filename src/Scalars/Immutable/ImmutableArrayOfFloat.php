<?php

declare(strict_types=1);

namespace ArrayOf\Scalars\Immutable;

use ArrayOf\AbstractArrayOf;
use ArrayOf\Traits\Immutable;

final class ImmutableArrayOfFloat extends AbstractArrayOf
{
    use Immutable;

    protected function typeToEnforce(): string
    {
        return self::SCALAR_DOUBLE;
    }
}
