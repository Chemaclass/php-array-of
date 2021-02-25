<?php

declare(strict_types=1);

namespace ArrayOf\Scalars\Mutable;

use ArrayOf\ArrayOf;

final class ArrayOfFloat extends ArrayOf
{
    protected function typeToEnforce(): string
    {
        return self::SCALAR_DOUBLE;
    }
}
