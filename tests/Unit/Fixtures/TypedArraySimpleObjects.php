<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit\Fixtures;

use TypedArrays\AbstractTypedArray;

final class TypedArraySimpleObjects extends AbstractTypedArray
{
    protected function typeToEnforce(): string
    {
        return SimpleObject::class;
    }
}
