<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit\Scalars;

use Generator;
use PHPUnit\Framework\TestCase;
use stdClass;
use TypedArrays\AbstractTypedArray;
use TypedArrays\Exceptions\ImmutabilityException;
use TypedArrays\Exceptions\InvalidTypeException;
use TypedArrays\Exceptions\MapException;
use TypedArrays\Scalars\ImmutableStringMap;

final class ImmutableStringMapTest extends TestCase
{
    public function test_construct(): void
    {
        $test = new ImmutableStringMap(['key' => 'test']);

        self::assertInstanceOf(ImmutableStringMap::class, $test);
        self::assertInstanceOf(AbstractTypedArray::class, $test);
    }

    /**
     * @dataProvider providerInvalidScalarInputType
     */
    public function test_invalid_scalar_input_type(array $arguments): void
    {
        $this->expectException(InvalidTypeException::class);

        new ImmutableStringMap($arguments);
    }

    public function providerInvalidScalarInputType(): Generator
    {
        yield 'Receiving integers' => [
            'arguments' => ['key1' => 1, 'key2' => 2],
        ];

        yield 'Receiving floats' => [
            'arguments' => ['key1' => 1.23, 'key2' => 4.56],
        ];

        yield 'Receiving booleans' => [
            'arguments' => ['key1' => true, 'key2' => false],
        ];

        yield 'Receiving stdClasses' => [
            'arguments' => ['key1' => new stdClass(), 'key2' => new stdClass()],
        ];

        yield 'Receiving a mix of all scalars' => [
            'arguments' => ['key1' => true, 'key2' => 1, 'key3' => 2.3, 'key4' => 'string', 'key5' => new stdClass()],
        ];
    }

    public function test_immutability_of_set(): void
    {
        $test = new ImmutableStringMap(['key' => 'test']);

        $this->expectException(ImmutabilityException::class);
        $this->expectExceptionMessage('This TypedArray object is immutable.');

        $test['invalid'] = 'invalid';
    }

    public function test_immutability_of_unset(): void
    {
        $test = new ImmutableStringMap(['key' => 'test']);

        $this->expectException(ImmutabilityException::class);
        $this->expectExceptionMessage('This TypedArray object is immutable.');

        unset($test['key']);
    }

    public function test_map_constructor_throws_an_exception_when_keys_are_not_specified(): void
    {
        $this->expectExceptionObject(MapException::keysRequired());

        new ImmutableStringMap(['invalid']);
    }

    public function test_map_constructor_does_not_throw_any_exception_when_keys_are_specified(): void
    {
        $test = new ImmutableStringMap(['valid' => 'test']);

        self::assertSame('test', $test['valid']);
    }

    public function test_map_constructor_doest_not_throw_any_exception_when_empty_array_given(): void
    {
        $test = new ImmutableStringMap([]);

        self::assertEmpty((array) $test);
    }
}
