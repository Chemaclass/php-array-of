<?php

declare(strict_types=1);

namespace ArrayOf\Exceptions;

use InvalidArgumentException;

final class InvalidSetupException extends InvalidArgumentException
{
    public static function forCollectionType(string $collectionType): self
    {
        return new self("Only available options: array, map or list. Selected: $collectionType");
    }

    public static function forEnforceType(string $typeToEnforce): self
    {
        return new self("ArrayOf objects can only enforce scalars and objects. Tried to enforce: $typeToEnforce");
    }
}
