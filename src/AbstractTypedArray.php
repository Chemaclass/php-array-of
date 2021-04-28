<?php

declare(strict_types=1);

namespace TypedArrays;

use ArrayObject;
use TypedArrays\Exceptions\GuardException;
use TypedArrays\Exceptions\InvalidTypeException;

abstract class AbstractTypedArray extends ArrayObject
{
    protected const SCALAR_BOOLEAN = 'boolean';
    protected const SCALAR_INTEGER = 'integer';
    protected const SCALAR_DOUBLE = 'double';
    protected const SCALAR_STRING = 'string';

    protected const COLLECTION_TYPE_ARRAY = 'array';
    protected const COLLECTION_TYPE_LIST = 'list';
    protected const COLLECTION_TYPE_MAP = 'map';

    private const POSSIBLE_SCALARS = [
        self::SCALAR_BOOLEAN,
        self::SCALAR_INTEGER,
        self::SCALAR_DOUBLE,
        self::SCALAR_STRING,
    ];

    private const POSSIBLE_COLLECTION_TYPES = [
        self::COLLECTION_TYPE_ARRAY,
        self::COLLECTION_TYPE_LIST,
        self::COLLECTION_TYPE_MAP,
    ];

    abstract protected function enforceType(): string;

    protected function collectionType(): string
    {
        return self::COLLECTION_TYPE_ARRAY;
    }

    protected function isMutable(): bool
    {
        return true;
    }

    protected function isNullable(): bool
    {
        return false;
    }

    /**
     * @throws InvalidTypeException
     * @throws GuardException
     */
    public function __construct(array $input = [])
    {
        $this->guardChildCollectionType();
        $this->guardChildEnforceType();

        $this->guardInstanceEnforceType($input);
        $this->guardInstanceList($input);
        $this->guardInstanceMap($input);

        parent::__construct($input);
    }

    /**
     * @param mixed $key
     * @param mixed $value
     *
     * @throws InvalidTypeException
     * @throws GuardException
     */
    public function offsetSet($key, $value): void
    {
        $this->guardMutability();
        $this->guardOffsetSetList($key);
        $this->guardOffsetSetMap($key);
        $this->guardOffsetSetType($value);

        parent::offsetSet($key, $value);
    }

    /**
     * @param mixed $key
     *
     * @throws GuardException
     */
    public function offsetUnset($key): void
    {
        $this->guardMutability();

        parent::offsetUnset($key);
    }

    /**
     * @throws GuardException
     */
    private function guardChildCollectionType(): void
    {
        if (!in_array($this->collectionType(), self::POSSIBLE_COLLECTION_TYPES)) {
            throw GuardException::invalidCollectionType($this->collectionType());
        }
    }

    /**
     * @throws GuardException
     */
    private function guardChildEnforceType(): void
    {
        if (
            !$this->checkForValidClass()
            && !$this->checkForScalar()
        ) {
            throw GuardException::invalidEnforceType($this->enforceType());
        }
    }

    private function checkForValidClass(): bool
    {
        return class_exists($this->enforceType())
            || interface_exists($this->enforceType());
    }

    private function checkForScalar(): bool
    {
        return in_array($this->enforceType(), self::POSSIBLE_SCALARS);
    }

    /**
     * @throws InvalidTypeException
     */
    private function guardInstanceEnforceType(array $input): void
    {
        foreach ($input as $item) {
            if (!$this->checkType($item)) {
                throw InvalidTypeException::onInstantiate(
                    static::class,
                    static::getType($item),
                    $this->enforceType()
                );
            }
        }
    }

    /**
     * @param mixed $variable
     */
    private function checkType($variable): bool
    {
        if ($variable === null) {
            return $this->isNullable();
        }

        if (is_object($variable)) {
            return get_class($variable) === $this->enforceType()
                || is_subclass_of($variable, $this->enforceType());
        }

        return static::getType($variable) === $this->enforceType();
    }

    /**
     * @param mixed $variable
     */
    private static function getType($variable): string
    {
        return is_object($variable)
            ? get_class($variable)
            : gettype($variable);
    }

    /**
     * @throws GuardException
     */
    private function guardInstanceList(array $input): void
    {
        if (
            $this->collectionType() === self::COLLECTION_TYPE_LIST
            && array_values($input) !== $input
        ) {
            throw GuardException::keysNotAllowedInList();
        }
    }

    /**
     * @throws GuardException
     */
    private function guardInstanceMap(array $input): void
    {
        if (
            !empty($input)
            && $this->collectionType() === self::COLLECTION_TYPE_MAP
            && array_values($input) === $input
        ) {
            throw GuardException::keysRequiredInMap();
        }
    }

    /**
     * @throws GuardException
     */
    private function guardMutability(): void
    {
        if (!$this->isMutable()) {
            throw GuardException::immutableCannotMutate();
        }
    }

    /**
     * @param mixed $key
     *
     * @throws GuardException
     */
    private function guardOffsetSetList($key): void
    {
        if (
            isset($key)
            && $this->collectionType() === self::COLLECTION_TYPE_LIST
            && !isset($this[$key])
        ) {
            throw GuardException::keysNotAllowedInList();
        }
    }

    /**
     * @param mixed $key
     *
     * @throws GuardException
     */
    private function guardOffsetSetMap($key): void
    {
        if (
            !isset($key)
            && $this->collectionType() === self::COLLECTION_TYPE_MAP
        ) {
            throw GuardException::keysRequiredInMap();
        }
    }

    /**
     * @param mixed $value
     *
     * @throws InvalidTypeException
     */
    private function guardOffsetSetType($value): void
    {
        if (!$this->checkType($value)) {
            throw InvalidTypeException::onAdd(
                static::class,
                static::getType($value),
                $this->enforceType()
            );
        }
    }
}
