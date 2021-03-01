<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Fixtures;

use ArrayOf\AbstractArrayOf;

final class ArrayOfSimpleObjects extends AbstractArrayOf
{
    protected function typeToEnforce(): string
    {
        return SimpleObject::class;
    }
}
