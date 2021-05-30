<?php

declare(strict_types=1);

namespace TypedArrays\Tests\Unit\Fixtures;

use TypedArrays\AbstractTypedArray;

final class TypedArraySimpleObjects extends AbstractTypedArray
{
    protected function enforceType(): string
    {
        return SimpleObject::class;
    }
}
