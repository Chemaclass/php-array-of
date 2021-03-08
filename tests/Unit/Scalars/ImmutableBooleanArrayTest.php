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
    public function testConstruct(): void
    {
        $test = new ImmutableBooleanArray([true]);

        self::assertInstanceOf(ImmutableBooleanArray::class, $test);
        self::assertInstanceOf(AbstractTypedArray::class, $test);
    }

    /**
     * @dataProvider providerInvalidScalarInputType
     */
    public function testInvalidScalarInputType(array $arguments): void
    {
        $this->expectException(InvalidTypeException::class);

        new ImmutableBooleanArray($arguments);
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

    public function testImmutabilityOfSet(): void
    {
        $test = new ImmutableBooleanArray([true]);

        $this->expectException(ImmutabilityException::class);
        $this->expectExceptionMessage('This TypedArray object is immutable.');

        $test[] = false;
    }

    public function testImmutabilityOfUnset(): void
    {
        $test = new ImmutableBooleanArray([false]);

        $this->expectException(ImmutabilityException::class);
        $this->expectExceptionMessage('This TypedArray object is immutable.');

        unset($test[0]);
    }
}
