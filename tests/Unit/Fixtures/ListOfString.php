<?php

declare(strict_types=1);

namespace ArrayOfTest\Unit\Fixtures;

use ArrayOf\AbstractArrayOf;

final class ListOfString extends AbstractArrayOf
{
    protected function typeToEnforce(): string
    {
        return self::SCALAR_STRING;
    }

    protected function collectionType(): string
    {
        return self::COLLECTION_TYPE_LIST;
    }
}
