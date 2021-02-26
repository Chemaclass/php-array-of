<?php

declare(strict_types=1);

namespace ArrayOf\Traits;

use ArrayOf\Exceptions\ImmutabilityException;
use ReflectionClass;

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
        $className = (new ReflectionClass($this))->getShortName();

        throw new ImmutabilityException($className);
    }

    /**
     * @param mixed $offset
     *
     * @throws ImmutabilityException
     */
    public function offsetUnset($offset): void
    {
        $className = (new ReflectionClass($this))->getShortName();

        throw new ImmutabilityException($className);
    }
}
