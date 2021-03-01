<?php

declare(strict_types=1);

namespace ArrayOf\Decorators;

use ArrayObject;
use ArrayOf\Exceptions\ListException;

final class MakeList extends ArrayObject
{
    /**
     * @param ArrayObject $input
     *
     * @throws ListException
     */
    public function __construct(ArrayObject $input)
    {
        self::checkForAssociative($input);

        parent::__construct($input);
    }

    /**
     * @param ArrayObject $input
     *
     * @throws ListException
     */
    private static function checkForAssociative(ArrayObject $input): void
    {
        if (array_values((array) $input) !== (array) $input) {
            throw new ListException();
        }
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     *
     * @throws ListException
     */
    public function offsetSet($offset, $value): void
    {
        if (isset($offset) && !isset($this[$offset])) {
            throw new ListException();
        }

        parent::offsetSet($offset, $value);
    }
}
