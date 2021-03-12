<?php

declare(strict_types=1);

namespace TypedArraysTest\Unit\Scalars;

use Generator;
use PHPUnit\Framework\TestCase;
use stdClass;
use TypedArrays\AbstractTypedArray;
use TypedArrays\Exceptions\GuardException;
use TypedArrays\Exceptions\InvalidTypeException;
use TypedArrays\Scalars\ImmutableIntegerMap;

final class ImmutableIntegerMapTest extends TestCase
{
    public function test_construct(): void
    {
        $test = new ImmutableIntegerMap(['key' => 1]);

        self::assertInstanceOf(ImmutableIntegerMap::class, $test);
        self::assertInstanceOf(AbstractTypedArray::class, $test);
    }

    /**
     * @dataProvider providerInvalidScalarInputType
     */
    public function test_invalid_scalar_input_type(array $arguments): void
    {
        $this->expectException(InvalidTypeException::class);

        new ImmutableIntegerMap($arguments);
    }

    public function providerInvalidScalarInputType(): Generator
    {
        yield 'Receiving floats' => [
            'arguments' => ['key1' => 1.23, 'key2' => 4.56],
        ];

        yield 'Receiving booleans' => [
            'arguments' => ['key1' => true, 'key2' => false],
        ];

        yield 'Receiving stdClasses' => [
            'arguments' => ['key1' => new stdClass(), 'key2' => new stdClass()],
        ];

        yield 'Receiving strings' => [
            'arguments' => ['key1' => 'str1', 'key2' => 'str2'],
        ];

        yield 'Receiving a mix of all scalars' => [
            'arguments' => ['key1' => true, 'key2' => 1, 'key3' => 2.3, 'key4' => 'string', 'key5' => new stdClass()],
        ];
    }

    public function test_immutability_of_set(): void
    {
        $test = new ImmutableIntegerMap(['key' => 1337]);

        $this->expectExceptionObject(GuardException::immutableCannotMutate());

        $test['invalid'] = 46;
    }

    public function test_immutability_of_unset(): void
    {
        $test = new ImmutableIntegerMap(['key' => 1984]);

        $this->expectExceptionObject(GuardException::immutableCannotMutate());

        unset($test['key']);
    }

    public function test_map_constructor_throws_an_exception_when_keys_are_not_specified(): void
    {
        $this->expectExceptionObject(GuardException::keysRequiredInMap());

        new ImmutableIntegerMap([13]);
    }

    public function test_map_constructor_does_not_throw_any_exception_when_keys_are_specified(): void
    {
        $test = new ImmutableIntegerMap(['valid' => 3]);

        self::assertSame(3, $test['valid']);
    }

    public function test_map_constructor_doest_not_throw_any_exception_when_empty_array_given(): void
    {
        $test = new ImmutableIntegerMap([]);

        self::assertEmpty((array) $test);
    }
}
