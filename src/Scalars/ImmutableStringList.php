<?php

declare(strict_types=1);

namespace TypedArrays\Scalars;

use TypedArrays\AbstractTypedArray;

final class ImmutableStringList extends AbstractTypedArray
{
    protected function typeToEnforce(): string
    {
        return self::SCALAR_STRING;
    }

    protected function isMutable(): bool
    {
        return false;
    }

    protected function collectionType(): string
    {
        return self::COLLECTION_TYPE_LIST;
    }
}
