<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit\Scalars;

use Generator;
use PHPUnit\Framework\TestCase;
use stdClass;
use TypedArrays\AbstractTypedArray;
use TypedArrays\Exceptions\ImmutabilityException;
use TypedArrays\Exceptions\InvalidTypeException;
use TypedArrays\Exceptions\ListException;
use TypedArrays\Scalars\ImmutableFloatList;

final class ImmutableFloatListTest extends TestCase
{
    public function test_construct(): void
    {
        $test = new ImmutableFloatList([1.5]);

        self::assertInstanceOf(ImmutableFloatList::class, $test);
        self::assertInstanceOf(AbstractTypedArray::class, $test);
    }

    /**
     * @dataProvider providerInvalidScalarInputType
     */
    public function test_invalid_scalar_input_type(array $arguments): void
    {
        $this->expectException(InvalidTypeException::class);

        new ImmutableFloatList($arguments);
    }

    public function test_immutability_of_set(): void
    {
        $test = new ImmutableFloatList([3.14]);

        $this->expectException(ImmutabilityException::class);
        $this->expectExceptionMessage('This TypedArray object is immutable.');

        $test[] = 6.28;
    }

    public function test_immutability_of_unset(): void
    {
        $test = new ImmutableFloatList([1.618]);

        $this->expectException(ImmutabilityException::class);
        $this->expectExceptionMessage('This TypedArray object is immutable.');

        unset($test[0]);
    }

    public function test_list_constructor_throws_an_exception_when_keys_are_specified(): void
    {
        $this->expectExceptionObject(ListException::keysNotAllowed());

        new ImmutableFloatList(['invalid' => 2.718]);
    }

    public function test_list_constructor_does_not_throw_any_exception_when_keys_are_not_specified(): void
    {
        $test = new ImmutableFloatList([137.5]);

        self::assertSame(137.5, $test[0]);
    }

    public function providerInvalidScalarInputType(): Generator
    {
        yield 'Receiving integers' => [
            'arguments' => [1, 2],
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
