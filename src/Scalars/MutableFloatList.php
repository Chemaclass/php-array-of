<?php

declare(strict_types=1);

namespace TypedArrays\Scalars;

use TypedArrays\AbstractTypedArray;

final class MutableFloatList extends AbstractTypedArray
{
    protected function typeToEnforce(): string
    {
        return self::SCALAR_DOUBLE;
    }

    protected function collectionType(): string
    {
        return self::COLLECTION_TYPE_LIST;
    }
}
