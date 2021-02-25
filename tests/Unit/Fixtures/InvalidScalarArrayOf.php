<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Fixtures;

use ArrayOf\ArrayOf;

final class InvalidScalarArrayOf extends ArrayOf
{
    protected function typeToEnforce(): string
    {
        return 'array';
    }
}
