<?php

declare(strict_types=1);

namespace ArrayOf\Scalars;

use ArrayOf\AbstractArrayOf;

final class ArrayOfFloat extends AbstractArrayOf
{
    protected function typeToEnforce(): string
    {
        return self::SCALAR_DOUBLE;
    }
}
