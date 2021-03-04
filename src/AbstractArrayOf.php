<?php

declare(strict_types=1);

namespace ArrayOf;

use ArrayObject;
use ArrayOf\Exceptions\ImmutabilityException;
use ArrayOf\Exceptions\InvalidSetupException;
use ArrayOf\Exceptions\InvalidTypeException;
use ArrayOf\Exceptions\ListException;

abstract class AbstractArrayOf extends ArrayObject
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
     * @param array $input
     *
     * @throws InvalidSetupException
     * @throws InvalidTypeException
     * @throws ListException
     */
    public function __construct(array $input = [])
    {
        if (!$this->checkCollectionType()) {
            throw InvalidSetupException::forCollectionType($this->collectionType());
        }

        if (!$this->checkTypeToEnforce()) {
            throw InvalidSetupException::forEnforceType($this->typeToEnforce());
        }

        if ($this->collectionType() === self::COLLECTION_TYPE_LIST) {
            self::checkForAssociative($input);
        }

        $this->guardEnforceType($input);

        parent::__construct($input);
    }

    private function checkTypeToEnforce(): bool
    {
        if ($this->checkForValidClass()) {
            return true;
        }

        return $this->checkForScalar();
    }

    private function checkCollectionType(): bool
    {
        return in_array($this->collectionType(), self::POSSIBLE_COLLECTION_TYPES);
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

    private function guardEnforceType(array $input): void
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
     * @param mixed $key
     * @param mixed $value
     *
     * @throws InvalidTypeException
     * @throws ImmutabilityException
     * @throws ListException
     */
    public function offsetSet($key, $value): void
    {
        if (!$this->isMutable()) {
            throw new ImmutabilityException();
        }

        if (
            isset($key) &&
            $this->collectionType() === self::COLLECTION_TYPE_LIST &&
            !isset($this[$key])
        ) {
            throw ListException::keysNotAllowed();
        }

        if (!$this->checkType($value)) {
            throw InvalidTypeException::onAdd(static::class, static::getType($value), $this->typeToEnforce());
        }

        parent::offsetSet($key, $value);
    }

    /**
     * @param mixed $key
     *
     * @throws ImmutabilityException
     */
    public function offsetUnset($key): void
    {
        if (!$this->isMutable()) {
            throw new ImmutabilityException();
        }

        parent::offsetUnset($key);
    }

    /**
     * @param array $input
     *
     * @throws ListException
     */
    private static function checkForAssociative(array $input): void
    {
        if (array_values($input) !== $input) {
            throw ListException::keysNotAllowed();
        }
    }
}
