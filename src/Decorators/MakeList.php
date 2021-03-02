<?php

declare(strict_types=1);

namespace ArrayOf\Decorators;

use ArrayObject;
use ArrayOf\Exceptions\ListException;

final class MakeList extends ArrayObject
{
    /**
     * @throws ListException
     */
    public function __construct(ArrayObject $input)
    {
        self::checkForAssociative($input);

        parent::__construct($input);
    }

    /**
     * @throws ListException
     */
    private static function checkForAssociative(ArrayObject $input): void
    {
        if (array_values((array) $input) !== (array) $input) {
            throw ListException::keysNotAllowed();
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
            throw ListException::keysNotAllowed();
        }

        parent::offsetSet($offset, $value);
    }
}
