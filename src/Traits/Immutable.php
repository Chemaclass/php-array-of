<?php

declare(strict_types=1);

namespace ArrayOf\Traits;

use ArrayOf\Exceptions\ImmutabilityException;

trait Immutable
{
    /**
     * @param mixed $offset
     * @param mixed $value
     *
     * @throws ImmutabilityException
     */
    public function offsetSet($offset, $value): void
    {
        throw new ImmutabilityException(self::class);
    }

    /**
     * @param mixed $offset
     *
     * @throws ImmutabilityException
     */
    public function offsetUnset($offset): void
    {
        throw new ImmutabilityException(self::class);
    }
}
