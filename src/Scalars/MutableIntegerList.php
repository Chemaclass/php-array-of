<?php

declare(strict_types=1);

namespace TypedArrays\Scalars;

use TypedArrays\AbstractTypedArray;

final class MutableIntegerList extends AbstractTypedArray
{
    protected function typeToEnforce(): string
    {
        return self::SCALAR_INTEGER;
    }

    protected function collectionType(): string
    {
        return self::COLLECTION_TYPE_LIST;
    }
}
