<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit\Fixtures;

use TypedArrays\AbstractTypedArray;

final class MapOfString extends AbstractTypedArray
{
    protected function typeToEnforce(): string
    {
        return self::SCALAR_STRING;
    }

    protected function collectionType(): string
    {
        return self::COLLECTION_TYPE_MAP;
    }
}
