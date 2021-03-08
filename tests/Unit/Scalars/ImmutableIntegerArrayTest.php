<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit\Scalars;

use Generator;
use PHPUnit\Framework\TestCase;
use stdClass;
use TypedArrays\AbstractTypedArray;
use TypedArrays\Exceptions\ImmutabilityException;
use TypedArrays\Exceptions\InvalidTypeException;
use TypedArrays\Scalars\ImmutableIntegerArray;

final class ImmutableIntegerArrayTest extends TestCase
{
    public function test_construct(): void
    {
        $test = new ImmutableIntegerArray([1]);

        self::assertInstanceOf(ImmutableIntegerArray::class, $test);
        self::assertInstanceOf(AbstractTypedArray::class, $test);
    }

    /**
     * @dataProvider providerInvalidScalarInputType
     */
    public function test_invalid_scalar_input_type(array $arguments): void
    {
        $this->expectException(InvalidTypeException::class);

        new ImmutableIntegerArray($arguments);
    }

    public function test_immutability_of_set(): void
    {
        $test = new ImmutableIntegerArray([1337]);

        $this->expectException(ImmutabilityException::class);
        $this->expectExceptionMessage('This TypedArray object is immutable.');

        $test[] = 46;
    }

    public function test_immutability_of_unset(): void
    {
        $test = new ImmutableIntegerArray([1984]);

        $this->expectException(ImmutabilityException::class);
        $this->expectExceptionMessage('This TypedArray object is immutable.');

        unset($test[0]);
    }

    public function providerInvalidScalarInputType(): Generator
    {
        yield 'Receiving floats' => [
            'arguments' => [1.23, 4.56],
        ];

        yield 'Receiving booleans' => [
            'arguments' => [true, false],
        ];

        yield 'Receiving stdClasses' => [
            'arguments' => [new stdClass(), new stdClass()],
        ];

        yield 'Receiving strings' => [
            'arguments' => ['str1', 'str2'],
        ];

        yield 'Receiving a mix of all scalars' => [
            'arguments' => [true, 1, 2.3, 'string', new stdClass()],
        ];
    }
}
