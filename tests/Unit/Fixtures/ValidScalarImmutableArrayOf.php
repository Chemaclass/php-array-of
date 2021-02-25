<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Fixtures;

use ArrayOf\ArrayOf;
use ArrayOf\Traits\Immutable;

final class ValidScalarImmutableArrayOf extends ArrayOf
{
    use Immutable;

    protected function typeToEnforce(): string
    {
        return 'string';
    }
}
