<?php

declare(strict_types=1);

namespace TypedArrays\Scalars;

use TypedArrays\AbstractTypedArray;

final class MutableBooleanList extends AbstractTypedArray
{
    protected function typeToEnforce(): string
    {
        return self::SCALAR_BOOLEAN;
    }

    protected function collectionType(): string
    {
        return self::COLLECTION_TYPE_LIST;
    }
}
