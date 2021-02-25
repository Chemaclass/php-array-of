<?php

declare(strict_types=1);

namespace ArrayOf;

use ArrayObject;
use ArrayOf\Exceptions\InvalidEnforcementType;
use ArrayOf\Exceptions\InvalidInstantiationType;

abstract class ArrayOf extends ArrayObject
{
    protected const SCALAR_BOOLEAN = 'boolean';
    protected const SCALAR_INTEGER = 'integer';
    protected const SCALAR_DOUBLE = 'double';
    protected const SCALAR_STRING = 'string';

    private const POSSIBLE_SCALARS = [
        self::SCALAR_BOOLEAN,
        self::SCALAR_INTEGER,
        self::SCALAR_DOUBLE,
        self::SCALAR_STRING,
    ];

    abstract protected function typeToEnforce(): string;

    /**
     * @throws InvalidEnforcementType
     * @throws InvalidInstantiationType
     */
    public function __construct(array $input = [], ?callable $filter = null)
    {
        if (!$this->checkEnforcementType()) {
            throw InvalidEnforcementType::forType($this->typeToEnforce());
        }

        parent::__construct($this->filteredInput($input, $filter));
    }

    private function filteredInput(array $input = [], ?callable $filter = null): array
    {
        $filteredInput = [];
        foreach ($input as $key => $item) {
            // Enforce type of array items
            if (!$this->checkType($item)) {
                throw InvalidInstantiationType::forType(static::class, static::getType($item), $this->typeToEnforce());
            }

            // Allow input to be filtered by callback
            if ($filter !== null && $filter($item) === false) {
                continue;
            }

            $filteredInput[$key] = $item;
        }

        return $filteredInput;
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

    private function checkEnforcementType(): bool
    {
        if ($this->checkForValidClass()) {
            return true;
        }

        return $this->checkForScalar();
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

    private function checkForValidClass(): bool
    {
        return class_exists($this->typeToEnforce())
            || interface_exists($this->typeToEnforce());
    }

    private function checkForScalar(): bool
    {
        return in_array($this->typeToEnforce(), self::POSSIBLE_SCALARS);
    }
}
