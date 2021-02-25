<?php

declare(strict_types=1);

namespace ArrayOf;

use ArrayOf\Exceptions\ImmutabilityException;

abstract class ImmutableArrayOf extends ArrayOf
{
    /**
     * @param mixed $offset
     * @param mixed $value
     *
     * @throws ImmutabilityException
     */
    public function offsetSet($offset, $value): void
    {
        throw new ImmutabilityException();
    }

    /**
     * @param mixed $offset
     *
     * @throws ImmutabilityException
     */
    public function offsetUnset($offset): void
    {
        throw new ImmutabilityException();
    }
}
