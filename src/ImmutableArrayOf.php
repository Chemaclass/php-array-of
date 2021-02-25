<?php

declare(strict_types=1);

namespace ArrayOf;

use ArrayOf\Exceptions\ImmutabilityException;

abstract class ImmutableArrayOf extends ArrayOf
{
    public function offsetSet($offset, $value): void
    {
        throw new ImmutabilityException();
    }

    public function offsetUnset($offset): void
    {
        throw new ImmutabilityException();
    }
}
