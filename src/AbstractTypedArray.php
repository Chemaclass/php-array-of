<?php

declare(strict_types=1);

namespace TypedArrays;

use ArrayObject;
use TypedArrays\Exceptions\ImmutabilityException;
use TypedArrays\Exceptions\InvalidSetupException;
use TypedArrays\Exceptions\InvalidTypeException;
use TypedArrays\Exceptions\ListException;
use TypedArrays\Exceptions\MapException;

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

    abstract protected function typeToEnforce(): string;

    protected function isMutable(): bool
    {
        return true;
    }

    protected function collectionType(): string
    {
        return self::COLLECTION_TYPE_ARRAY;
    }

    /**
     * @throws InvalidSetupException
     * @throws InvalidTypeException
     * @throws ListException
     * @throws MapException
     */
    public function __construct(array $input = [])
    {
        $this->guardChildCollectionType();
        $this->guardChildTypeToEnforce();

        $this->guardInstanceTypeToEnforce($input);
        $this->guardInstanceList($input);
        $this->guardInstanceMap($input);

        parent::__construct($input);
    }

    /**
     * @param mixed $key
     * @param mixed $value
     *
     * @throws InvalidTypeException
     * @throws ImmutabilityException
     * @throws ListException
     * @throws MapException
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
     * @throws ImmutabilityException
     */
    public function offsetUnset($key): void
    {
        $this->guardMutability();

        parent::offsetUnset($key);
    }

    /**
     * @throws InvalidTypeException
     */
    private function guardChildCollectionType(): void
    {
        if (!in_array($this->collectionType(), self::POSSIBLE_COLLECTION_TYPES)) {
            throw InvalidSetupException::forCollectionType($this->collectionType());
        }
    }

    /**
     * @throws InvalidSetupException
     */
    private function guardChildTypeToEnforce(): void
    {
        if (
            !$this->checkForValidClass() &&
            !$this->checkForScalar()
        ) {
            throw InvalidSetupException::forEnforceType($this->typeToEnforce());
        }
    }

    private function checkForValidClass(): bool
    {
        return class_exists($this->typeToEnforce())
            || interface_exists($this->typeToEnforce());
    }

    private function checkForScalar(): bool
    {
        return in_array($this->typeToEnforce(), self::POSSIBLE_SCALARS);
    }

    /**
     * @throws InvalidTypeException
     */
    private function guardInstanceTypeToEnforce(array $input): void
    {
        array_map(function ($item): void {
            if (!$this->checkType($item)) {
                throw InvalidTypeException::onInstantiate(static::class, static::getType($item), $this->typeToEnforce());
            }
        }, $input);
    }

    /**
     * @param mixed $variable
     */
    private function checkType($variable): bool
    {
        if (is_object($variable)) {
            return get_class($variable) === $this->typeToEnforce()
                || is_subclass_of($variable, $this->typeToEnforce());
        }

        return static::getType($variable) === $this->typeToEnforce();
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
     * @throws ListException
     */
    private function guardInstanceList(array $input): void
    {
        if (
            $this->collectionType() === self::COLLECTION_TYPE_LIST &&
            array_values($input) !== $input
        ) {
            throw ListException::keysNotAllowed();
        }
    }

    /**
     * @throws MapException
     */
    private function guardInstanceMap(array $input): void
    {
        if (
            $this->collectionType() === self::COLLECTION_TYPE_MAP &&
            array_values($input) === $input
        ) {
            throw MapException::keysRequired();
        }
    }

    /**
     * @throws ImmutabilityException
     */
    private function guardMutability(): void
    {
        if (!$this->isMutable()) {
            throw new ImmutabilityException();
        }
    }

    /**
     * @param mixed $key
     *
     * @throws ListException
     */
    private function guardOffsetSetList($key): void
    {
        if (
            isset($key)
            && $this->collectionType() === self::COLLECTION_TYPE_LIST
            && !isset($this[$key])
        ) {
            throw ListException::keysNotAllowed();
        }
    }

    /**
     * @param mixed $key
     *
     * @throws MapException
     */
    private function guardOffsetSetMap($key): void
    {
        if (
            !isset($key)
            && $this->collectionType() === self::COLLECTION_TYPE_MAP
        ) {
            throw MapException::keysRequired();
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
            throw InvalidTypeException::onAdd(static::class, static::getType($value), $this->typeToEnforce());
        }
    }
}
