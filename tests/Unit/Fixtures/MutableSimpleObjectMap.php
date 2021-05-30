<?php

declare(strict_types=1);

namespace TypedArrays\Tests\Unit\Fixtures;

use TypedArrays\AbstractTypedArray;

final class MutableSimpleObjectMap extends AbstractTypedArray
{
    protected function enforceType(): string
    {
        return SimpleObject::class;
    }

    protected function collectionType(): string
    {
        return self::COLLECTION_TYPE_MAP;
    }
}
