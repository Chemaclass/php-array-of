<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Fixtures;

use ArrayOf\AbstractArrayOf;

final class ImmutableArrayOfSimpleObjects extends AbstractArrayOf
{
    protected function typeToEnforce(): string
    {
        return SimpleObject::class;
    }

    protected function isMutable(): bool
    {
        return false;
    }
}
