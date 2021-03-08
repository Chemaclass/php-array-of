<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit\Scalars;

use Generator;
use PHPUnit\Framework\TestCase;
use stdClass;
use TypedArrays\AbstractTypedArray;
use TypedArrays\Exceptions\ImmutabilityException;
use TypedArrays\Exceptions\InvalidTypeException;
use TypedArrays\Scalars\ImmutableBooleanArray;

final class ImmutableBooleanArrayTest extends TestCase
{
    public function test_construct(): void
    {
        $test = new ImmutableBooleanArray([true]);

        self::assertInstanceOf(ImmutableBooleanArray::class, $test);
        self::assertInstanceOf(AbstractTypedArray::class, $test);
    }

    /**
     * @dataProvider providerInvalidScalarInputType
     */
    public function test_invalid_scalar_input_type(array $arguments): void
    {
        $this->expectException(InvalidTypeException::class);

        new ImmutableBooleanArray($arguments);
    }

    public function test_immutability_of_set(): void
    {
        $test = new ImmutableBooleanArray([true]);

        $this->expectException(ImmutabilityException::class);
        $this->expectExceptionMessage('This TypedArray object is immutable.');

        $test[] = false;
    }

    public function test_immutability_of_unset(): void
    {
        $test = new ImmutableBooleanArray([false]);

        $this->expectException(ImmutabilityException::class);
        $this->expectExceptionMessage('This TypedArray object is immutable.');

        unset($test[0]);
    }

    public function providerInvalidScalarInputType(): Generator
    {
        yield 'Receiving integers' => [
            'arguments' => [1, 2],
        ];

        yield 'Receiving floats' => [
            'arguments' => [1.23, 4.56],
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
