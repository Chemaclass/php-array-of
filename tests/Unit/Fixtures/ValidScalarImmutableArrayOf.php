<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Fixtures;

use ArrayOf\ImmutableArrayOf;

final class ValidScalarImmutableArrayOf extends ImmutableArrayOf
{
    protected function typeToEnforce(): string
    {
        return 'string';
    }
}
