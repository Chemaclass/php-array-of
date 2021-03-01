<?php

declare(strict_types=1);

namespace ArrayOf\Decorators;

use ArrayObject;
use ArrayOf\Exceptions\ImmutabilityException;

final class MakeImmutable extends ArrayObject
{
    public function __construct(ArrayObject $input)
    {
        parent::__construct($input);
    }

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
